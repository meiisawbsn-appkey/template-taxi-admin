# Laravel Blade Layout Conversion Guide

## Overview

This guide provides step-by-step instructions for converting all existing Laravel Blade files to use the new layout system with reusable components.

## New Structure Created

-   `layouts/app.blade.php` - Master layout template
-   `partials/header.blade.php` - Reusable header component
-   `partials/sidebar.blade.php` - Reusable sidebar navigation
-   Examples: `dashboard-new.blade.php`, `user-management-new.blade.php`, `login-new.blade.php`

## Two Conversion Patterns

### Pattern 1: Admin Pages (with sidebar/header)

For pages that use the admin layout with sidebar and header:

**Original Structure:**

```php
<!DOCTYPE html>
<html>
<head>...</head>
<body>
    <!-- Full HTML structure -->
    <!-- Sidebar -->
    <!-- Header -->
    <!-- Main content -->
</body>
</html>
```

**New Structure:**

```php
@extends('layouts.app')

@section('title', 'Page Title - TaksiKu')
@section('header', 'Page Header')
@section('subheader', 'Optional subheader text')
@section('action-button', 'Button Text')

@push('styles')
<style>
    /* Page-specific styles */
</style>
@endpush

@section('content')
    <!-- Only the main content here -->
@endsection

@push('scripts')
<script>
    // Page-specific JavaScript
</script>
@endpush
```

### Pattern 2: Standalone Pages (like login)

For pages that don't use the admin layout:

Keep as standalone HTML files but ensure:

-   Change background from gradients to `#ffffff`
-   Keep complete HTML structure
-   Update styles for white background theme

## Files to Convert

### Admin Layout Files (Use Pattern 1):

1. `balance.blade.php` → convert to @extends
2. `balance-detail.blade.php` → convert to @extends
3. `dashboard.blade.php` → replace with dashboard-new.blade.php
4. `driver-registration.blade.php` → convert to @extends
5. `driver-registration-details.blade.php` → convert to @extends
6. `feedback.blade.php` → convert to @extends
7. `feedback-details.blade.php` → convert to @extends
8. `finance-order.blade.php` → convert to @extends
9. `order-page.blade.php` → convert to @extends
10. `order-page-details.blade.php` → convert to @extends
11. `price-setting.blade.php` → convert to @extends
12. `user-management.blade.php` → replace with user-management-new.blade.php
13. `user-details.blade.php` → convert to @extends
14. `vehicle-page.blade.php` → convert to @extends
15. `vehicle-page-details.blade.php` → convert to @extends
16. `welcome.blade.php` → convert to @extends

### Standalone Files (Use Pattern 2):

1. `login.blade.php` → replace with login-new.blade.php

## Step-by-Step Conversion Process

### For Admin Layout Files:

1. **Identify the main content section**

    - Find the content between sidebar and main content area
    - Usually starts after `<div class="main-content">` or similar

2. **Extract page-specific styles**

    - Find `<style>` blocks specific to this page
    - Move to `@push('styles')` section

3. **Extract page-specific scripts**

    - Find `<script>` blocks specific to this page
    - Move to `@push('scripts')` section

4. **Set page metadata**

    - Set `@section('title')` for page title
    - Set `@section('header')` for main heading
    - Set `@section('subheader')` if applicable
    - Set `@section('action-button')` if there's a main action

5. **Create new file structure**

    ```php
    @extends('layouts.app')

    @section('title', 'Your Page Title - TaksiKu')
    @section('header', 'Your Page Header')

    @push('styles')
    <!-- Page styles here -->
    @endpush

    @section('content')
    <!-- Main content here -->
    @endsection

    @push('scripts')
    <!-- Page scripts here -->
    @endpush
    ```

### Example Conversion (balance.blade.php):

**Before:**

```php
<!DOCTYPE html>
<html>
<head>
    <title>Balance - TaksiKu</title>
    <!-- styles -->
</head>
<body>
    <!-- sidebar -->
    <!-- header -->
    <div class="main-content">
        <div class="header">
            <h1>Saldo & Transaksi</h1>
        </div>
        <!-- balance content -->
    </div>
    <!-- scripts -->
</body>
</html>
```

**After:**

```php
@extends('layouts.app')

@section('title', 'Saldo & Transaksi - TaksiKu')
@section('header', 'Saldo & Transaksi')
@section('subheader', 'Kelola saldo dan riwayat transaksi')

@section('content')
    <!-- balance content only -->
@endsection
```

## Benefits of This Approach

1. **DRY Principle** - No duplicate code for layout structure
2. **Consistency** - All pages use same header/sidebar/styling
3. **Maintainability** - Changes to layout affect all pages automatically
4. **Performance** - Reduced file sizes and better caching
5. **Scalability** - Easy to add new pages using existing layout

## Testing Converted Files

After conversion, test each page to ensure:

-   ✅ Layout renders correctly
-   ✅ Sidebar navigation works
-   ✅ Header displays proper title
-   ✅ Page-specific styles load
-   ✅ JavaScript functionality works
-   ✅ White background is applied consistently

## File Naming Convention

-   Keep original files for backup
-   Create new versions with `-new` suffix during development
-   Replace original files after testing
-   Example: `dashboard.blade.php` → `dashboard-new.blade.php` → test → replace original
