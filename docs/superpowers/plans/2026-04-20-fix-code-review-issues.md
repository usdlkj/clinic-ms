# Fix Code Review Issues Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Fix all Critical and Important issues identified in the post-Select2 code review: typo in VisitAPIController, unauthenticated API routes, null-crash risk, soft-delete bypass, duplicated Select2 assets, debug log leak, show-view regression, and missing test infrastructure.

**Architecture:** Four PHP/Blade fixes followed by test restoration. Each task is independent of the others except Task 5 (tests) which depends on Tasks 1–4 being correct. No new routes or models are introduced — only bug fixes and consolidation.

**Tech Stack:** Laravel 8, Blade, PHP 8, PHPUnit, SQLite (in-memory for tests), Select2 4.1.0-beta.1

---

## File Map

| File | Change |
|---|---|
| `app/Http/Controllers/API/VisitAPIController.php` | Fix typo, docblock, null guard, use Eloquent |
| `routes/api.php` | Add auth middleware |
| `resources/views/layouts/app.blade.php` | `@yield('styles')` → `@stack('styles')` |
| `resources/views/visits/fields.blade.php` | Add Select2 CSS + JS init via `@push` |
| `resources/views/visits/create.blade.php` | Remove duplicate Select2 block |
| `resources/views/visits/edit.blade.php` | Remove duplicate Select2 block, remove `console.log` |
| `resources/views/patients/create.blade.php` | Remove duplicate Select2 block |
| `resources/views/visits/show_fields.blade.php` | Restore `textarea` for diagnosis |
| `phpunit.xml` | Enable SQLite in-memory |
| `tests/TestCase.php` | Create (restore) |
| `tests/CreatesApplication.php` | Create (restore) |
| `tests/Feature/VisitAPIControllerTest.php` | Create new feature tests |

---

## Task 1: Fix typo and class docblock in VisitAPIController

**Files:**
- Modify: `app/Http/Controllers/API/VisitAPIController.php`

- [ ] **Step 1: Fix `$this->visitsRepository` typo (6 occurrences)**

  In `app/Http/Controllers/API/VisitAPIController.php`, lines 36, 99, 115, 138, 144, 162 all reference `$this->visitsRepository` (plural). The constructor assigns `$this->visitRepository` (singular). Replace all six occurrences:

  Line 36:
  ```php
  // BEFORE
  $visits = $this->visitsRepository->all(
  // AFTER
  $visits = $this->visitRepository->all(
  ```

  Line 99:
  ```php
  // BEFORE
  $visits = $this->visitsRepository->create($input);
  // AFTER
  $visits = $this->visitRepository->create($input);
  ```

  Line 115:
  ```php
  // BEFORE
  $visits = $this->visitsRepository->find($id);
  // AFTER
  $visits = $this->visitRepository->find($id);
  ```

  Line 138:
  ```php
  // BEFORE
  $visits = $this->visitsRepository->find($id);
  // AFTER
  $visits = $this->visitRepository->find($id);
  ```

  Line 144:
  ```php
  // BEFORE
  $visits = $this->visitsRepository->update($input, $id);
  // AFTER
  $visits = $this->visitRepository->update($input, $id);
  ```

  Line 162:
  ```php
  // BEFORE
  $visits = $this->visitsRepository->find($id);
  // AFTER
  $visits = $this->visitRepository->find($id);
  ```

- [ ] **Step 2: Fix class docblock**

  Line 13, change:
  ```php
  // BEFORE
  /**
   * Class VisitController
   * @package App\Http\Controllers\API
   */
  // AFTER
  /**
   * Class VisitAPIController
   * @package App\Http\Controllers\API
   */
  ```

- [ ] **Step 3: Commit**

  ```bash
  git add app/Http/Controllers/API/VisitAPIController.php
  git commit -m "fix: correct visitsRepository typo and class docblock in VisitAPIController"
  ```

---

## Task 2: Harden API endpoints — null guard, Eloquent soft-delete, auth middleware

**Files:**
- Modify: `app/Http/Controllers/API/VisitAPIController.php`
- Modify: `routes/api.php`

- [ ] **Step 1: Replace `DB::table` with Eloquent in `getDistinctDiagnosis`**

  The current query uses `DB::table('visits')` which ignores the `SoftDeletes` global scope, so deleted visits' diagnoses appear in the autocomplete. Replace lines 50–53:

  ```php
  // BEFORE
  $diagnosis = DB::table('visits')
      ->select('diagnosis')
      ->distinct()
      ->get();
  // AFTER
  $diagnosis = Visit::select('diagnosis')->distinct()->get();
  ```

- [ ] **Step 2: Add null guard and use Eloquent in `getDiagnosisByVisitId`**

  Replace the body of `getDiagnosisByVisitId` (lines 76–85):

  ```php
  public function getDiagnosisByVisitId($id)
  {
      $visit = Visit::find($id);
      if (!$visit) {
          return response()->json(['results' => []], 404);
      }
      $results = [
          ['id' => $visit->diagnosis, 'text' => $visit->diagnosis]
      ];

      return ['results' => $results];
  }
  ```

- [ ] **Step 3: Remove unused `DB` import**

  Remove line 8 from the controller imports:
  ```php
  // DELETE this line:
  use Illuminate\Support\Facades\DB;
  ```

- [ ] **Step 4: Add `auth` middleware to both API routes**

  In `routes/api.php`, change lines 21–22:
  ```php
  // BEFORE
  Route::get('visits/diagnosis', [App\Http\Controllers\API\VisitAPIController::class, 'getDistinctDiagnosis'])->name('visits.diagnosis');
  Route::get('visit/diagnosis/{id}', [App\Http\Controllers\API\VisitAPIController::class, 'getDiagnosisByVisitId'])->name('visit.diagnosis.by.id');

  // AFTER
  Route::middleware('auth')->group(function () {
      Route::get('visits/diagnosis', [App\Http\Controllers\API\VisitAPIController::class, 'getDistinctDiagnosis'])->name('visits.diagnosis');
      Route::get('visit/diagnosis/{id}', [App\Http\Controllers\API\VisitAPIController::class, 'getDiagnosisByVisitId'])->name('visit.diagnosis.by.id');
  });
  ```

  > **Why `auth` not `auth:api`?** These routes are called via browser AJAX from authenticated web sessions (cookies). The `auth:api` guard requires a token. The default `auth` guard uses the session, which the logged-in user already has.

- [ ] **Step 5: Commit**

  ```bash
  git add app/Http/Controllers/API/VisitAPIController.php routes/api.php
  git commit -m "fix: use Eloquent in API endpoints, guard against null visit, protect routes with auth middleware"
  ```

---

## Task 3: Consolidate Select2 assets into the fields partial

**Files:**
- Modify: `resources/views/layouts/app.blade.php`
- Modify: `resources/views/visits/fields.blade.php`
- Modify: `resources/views/visits/create.blade.php`
- Modify: `resources/views/visits/edit.blade.php`
- Modify: `resources/views/patients/create.blade.php`

- [ ] **Step 1: Change `@yield('styles')` to `@stack('styles')` in the layout**

  In `resources/views/layouts/app.blade.php`, line 27:
  ```blade
  {{-- BEFORE --}}
  @yield('styles')

  {{-- AFTER --}}
  @stack('styles')
  ```

  > `@stack` / `@push` allows partials to inject content; `@yield` / `@section` only works from the top-level view. Partials cannot use `@section`.

- [ ] **Step 2: Add Select2 CSS and JS init to `visits/fields.blade.php`**

  Append to the end of `resources/views/visits/fields.blade.php`:

  ```blade
  @push('styles')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  @endpush

  @push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  <script type="text/javascript">
  $('#diagnosis').select2({
      ajax: {
          url: '/api/visits/diagnosis',
      },
      tags: true
  });
  </script>
  @endpush
  ```

- [ ] **Step 3: Remove duplicate Select2 block from `visits/create.blade.php`**

  Delete lines 47–63 (the entire `@section('styles')` block and the `@push('scripts')` block containing Select2):

  ```blade
  {{-- DELETE these lines: --}}
  @section('styles')
  <!-- Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  @endsection

  @push('scripts')
  <!-- Select2 -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  <script type="text/javascript">
  $('#diagnosis').select2({
      ajax: {
          url: '/api/visits/diagnosis',
      },
      tags: true
  });
  </script>
  @endpush
  ```

- [ ] **Step 4: Remove duplicate Select2 block from `visits/edit.blade.php`**

  Delete lines 47–61 (`@section('styles')` and the `@push('scripts')` block containing the Select2 CDN + init). Keep the preselection AJAX block that remains (it starts with `// Fetch the preselected item`).

  The file after this step should end with only the preselection block:
  ```blade
  @push('scripts')
  <script type="text/javascript">
  // Fetch the preselected item, and add to the control
  var diagnosisSelect = $('#diagnosis');
  $.ajax({
      type: 'GET',
      url: '/api/visit/diagnosis/{{$visit->id}}'
  }).then(function (data) {
      var diagnosis = data.results[0];
      var option = new Option(diagnosis.text, diagnosis.id, true, true);
      diagnosisSelect.append(option).trigger('change');
      diagnosisSelect.trigger({
          type: 'select2:select',
          params: {
              data: data
          }
      });
  });
  </script>
  @endpush
  ```

  Note: `console.log(data.results)` is removed in this step (see Task 4 Step 1 — it is included here for completeness).

- [ ] **Step 5: Remove duplicate Select2 block from `patients/create.blade.php`**

  Delete lines 48–64 (the `@section('styles')` and `@push('scripts')` Select2 block):

  ```blade
  {{-- DELETE these lines: --}}
  @section('styles')
  <!-- Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  @endsection

  @push('scripts')
  <!-- Select2 -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  <script type="text/javascript">
  $('#diagnosis').select2({
      ajax: {
          url: '/api/visits/diagnosis',
      },
      tags: true
  });
  </script>
  @endpush
  ```

- [ ] **Step 6: Verify manually**

  Start the dev server and open each of these three pages while logged in:
  - Patient create (`/patients/create`) — diagnosis Select2 should load
  - Visit create (navigate to a patient → new visit) — diagnosis Select2 should load
  - Visit edit — diagnosis Select2 should load and preselect the existing diagnosis

  ```bash
  php artisan serve
  ```

- [ ] **Step 7: Commit**

  ```bash
  git add resources/views/layouts/app.blade.php \
          resources/views/visits/fields.blade.php \
          resources/views/visits/create.blade.php \
          resources/views/visits/edit.blade.php \
          resources/views/patients/create.blade.php
  git commit -m "refactor: consolidate Select2 assets into visits/fields partial"
  ```

---

## Task 4: Fix view regressions

**Files:**
- Modify: `resources/views/visits/show_fields.blade.php`

- [ ] **Step 1: Restore `textarea` for diagnosis in show_fields**

  In `resources/views/visits/show_fields.blade.php`, line 21, the diagnosis was downgraded from `textarea` to `text`. Restore it (and remove the meaningless `rows` attribute that was carried over):

  ```blade
  {{-- BEFORE --}}
  {!! Form::text('diagnosis', $visit->diagnosis, ['class' => 'form-control', 'readonly', 'rows' => '5']) !!}

  {{-- AFTER --}}
  {!! Form::textarea('diagnosis', $visit->diagnosis, ['class' => 'form-control', 'rows' => '5', 'readonly']) !!}
  ```

- [ ] **Step 2: Commit**

  ```bash
  git add resources/views/visits/show_fields.blade.php
  git commit -m "fix: restore textarea for diagnosis in visit show view"
  ```

---

## Task 5: Restore test infrastructure and add feature tests

**Files:**
- Modify: `phpunit.xml`
- Create: `tests/TestCase.php`
- Create: `tests/CreatesApplication.php`
- Create: `tests/Feature/VisitAPIControllerTest.php`

- [ ] **Step 1: Enable SQLite in-memory database for tests**

  In `phpunit.xml`, uncomment lines 24–25:

  ```xml
  <!-- BEFORE -->
  <!-- <server name="DB_CONNECTION" value="sqlite"/> -->
  <!-- <server name="DB_DATABASE" value=":memory:"/> -->

  <!-- AFTER -->
  <server name="DB_CONNECTION" value="sqlite"/>
  <server name="DB_DATABASE" value=":memory:"/>
  ```

- [ ] **Step 2: Create `tests/CreatesApplication.php`**

  ```php
  <?php

  namespace Tests;

  use Illuminate\Contracts\Console\Kernel;
  use Illuminate\Foundation\Application;

  trait CreatesApplication
  {
      public function createApplication(): Application
      {
          $app = require __DIR__.'/../bootstrap/app.php';
          $app->make(Kernel::class)->bootstrap();
          return $app;
      }
  }
  ```

- [ ] **Step 3: Create `tests/TestCase.php`**

  ```php
  <?php

  namespace Tests;

  use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

  abstract class TestCase extends BaseTestCase
  {
      use CreatesApplication;
  }
  ```

- [ ] **Step 4: Write failing tests first**

  Create `tests/Feature/VisitAPIControllerTest.php`:

  ```php
  <?php

  namespace Tests\Feature;

  use App\Models\Patient;
  use App\Models\User;
  use App\Models\Visit;
  use Illuminate\Foundation\Testing\RefreshDatabase;
  use Tests\TestCase;

  class VisitAPIControllerTest extends TestCase
  {
      use RefreshDatabase;

      private User $user;

      protected function setUp(): void
      {
          parent::setUp();
          $this->user = User::factory()->create();
      }

      /** @test */
      public function getDistinctDiagnosis_requires_authentication(): void
      {
          $this->getJson('/api/visits/diagnosis')
               ->assertStatus(401);
      }

      /** @test */
      public function getDiagnosisByVisitId_requires_authentication(): void
      {
          $this->getJson('/api/visit/diagnosis/1')
               ->assertStatus(401);
      }

      /** @test */
      public function getDistinctDiagnosis_returns_unique_diagnoses(): void
      {
          $patient = Patient::factory()->create();
          Visit::factory()->create(['patient_id' => $patient->id, 'diagnosis' => 'Flu']);
          Visit::factory()->create(['patient_id' => $patient->id, 'diagnosis' => 'Flu']);
          Visit::factory()->create(['patient_id' => $patient->id, 'diagnosis' => 'Hypertension']);

          $response = $this->actingAs($this->user)
                           ->getJson('/api/visits/diagnosis');

          $response->assertStatus(200);
          $results = $response->json('results');
          $this->assertCount(2, $results);
          $this->assertTrue(collect($results)->pluck('id')->contains('Flu'));
          $this->assertTrue(collect($results)->pluck('id')->contains('Hypertension'));
      }

      /** @test */
      public function getDistinctDiagnosis_excludes_soft_deleted_visits(): void
      {
          $patient = Patient::factory()->create();
          $visit = Visit::factory()->create(['patient_id' => $patient->id, 'diagnosis' => 'DeletedDisease']);
          $visit->delete();

          $response = $this->actingAs($this->user)
                           ->getJson('/api/visits/diagnosis');

          $response->assertStatus(200);
          $results = $response->json('results');
          $this->assertFalse(collect($results)->pluck('id')->contains('DeletedDisease'));
      }

      /** @test */
      public function getDiagnosisByVisitId_returns_diagnosis_for_valid_visit(): void
      {
          $patient = Patient::factory()->create();
          $visit = Visit::factory()->create(['patient_id' => $patient->id, 'diagnosis' => 'Diabetes']);

          $response = $this->actingAs($this->user)
                           ->getJson("/api/visit/diagnosis/{$visit->id}");

          $response->assertStatus(200)
                   ->assertJson([
                       'results' => [
                           ['id' => 'Diabetes', 'text' => 'Diabetes']
                       ]
                   ]);
      }

      /** @test */
      public function getDiagnosisByVisitId_returns_404_for_missing_visit(): void
      {
          $this->actingAs($this->user)
               ->getJson('/api/visit/diagnosis/99999')
               ->assertStatus(404);
      }

      /** @test */
      public function getDiagnosisByVisitId_returns_404_for_soft_deleted_visit(): void
      {
          $patient = Patient::factory()->create();
          $visit = Visit::factory()->create(['patient_id' => $patient->id, 'diagnosis' => 'Gone']);
          $visit->delete();

          $this->actingAs($this->user)
               ->getJson("/api/visit/diagnosis/{$visit->id}")
               ->assertStatus(404);
      }
  }
  ```

- [ ] **Step 5: Run tests to verify they fail for the right reasons**

  ```bash
  cd /Users/ivantanu/Documents/01_PT_KAPZET/Project-Clinic/clinic-ms
  php artisan test tests/Feature/VisitAPIControllerTest.php --verbose
  ```

  Expected: tests that rely on authentication should pass (auth middleware already added in Task 2). All tests should pass if Tasks 1–4 are complete. If any fail, read the error and fix the underlying issue (do not change the test).

- [ ] **Step 6: Run full test suite**

  ```bash
  php artisan test --verbose
  ```

  Expected: all tests pass with no errors.

- [ ] **Step 7: Commit**

  ```bash
  git add phpunit.xml tests/
  git commit -m "test: restore test infrastructure and add feature tests for VisitAPIController"
  ```

---

## Self-Review Checklist

- [x] **Critical #1** (typo) → Task 1
- [x] **Critical #2** (unauthenticated routes) → Task 2, Step 4
- [x] **Critical #3** (null crash in getDiagnosisByVisitId) → Task 2, Step 2
- [x] **Critical #4** (soft-delete bypass) → Task 2, Steps 1–2
- [x] **Important #5** (Select2 duplication) → Task 3
- [x] **Important #6** (console.log) → Task 3, Step 4 (removed when rewriting the preselection block)
- [x] **Important #7** (diagnosis downgraded to text input) → Task 4
- [x] **Important #8** (tests deleted) → Task 5
- [x] **Minor #11** (wrong docblock) → Task 1, Step 2
