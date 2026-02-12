# CSS Modernization Guide - Pinjamdulu

## 📚 Panduan Penggunaan Custom CSS

### 1. Color Palette

```css
/* CSS Variables untuk Color Palette */
--primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%)
--primary-color: #667eea
--secondary-color: #764ba2
--success-color: #43e97b
--danger-color: #f5576c
--warning-color: #f093fb
--info-color: #4facfe
--light-bg: #f5f7fa
```

### 2. Shadow System

```css
--card-shadow: 0 4px 15px rgba(0, 0, 0, 0.08)
--card-shadow-hover: 0 8px 25px rgba(0, 0, 0, 0.12)
```

### 3. Component Styling

#### Stat Cards
```blade
<div class="stat-card">
    <h6>Label</h6>
    <h3>Value</h3>
</div>
```

Features:
- Gradient backgrounds
- Hover animations
- Responsive sizing

#### Badges
```blade
<span class="badge bg-success">Success</span>
<span class="badge bg-danger">Danger</span>
<span class="badge bg-warning">Warning</span>
<span class="badge bg-info">Info</span>
```

All badges come with:
- Gradient backgrounds
- Drop shadows
- Proper spacing

#### Tables
```blade
<table class="table table-hover">
    <thead>
        <tr>
            <th>Header</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Data</td>
        </tr>
    </tbody>
</table>
```

Features:
- Gradient header background
- Hover row effects
- Responsive scrolling
- Better spacing

#### Forms
```blade
<div class="form-group">
    <label class="form-label">Label</label>
    <input type="text" class="form-control" placeholder="Placeholder">
</div>
```

Features:
- Custom border colors
- Focus states dengan color gradients
- Smooth transitions
- Clear accessibility

#### Buttons

**Primary Button:**
```blade
<button class="btn btn-primary">Click Me</button>
```

**Success Button:**
```blade
<button class="btn btn-success">Success</button>
```

**Danger Button:**
```blade
<button class="btn btn-danger">Delete</button>
```

**Warning Button:**
```blade
<button class="btn btn-warning">Warning</button>
```

**Info Button:**
```blade
<button class="btn btn-info">Info</button>
```

All buttons feature:
- Gradient backgrounds
- Hover animations dengan translateY
- Drop shadows
- Consistent sizing

#### Alerts
```blade
<!-- Success Alert -->
<div class="alert alert-success">
    Your operation was successful!
</div>

<!-- Danger Alert -->
<div class="alert alert-danger">
    An error occurred!
</div>

<!-- Warning Alert -->
<div class="alert alert-warning">
    Warning message here
</div>

<!-- Info Alert -->
<div class="alert alert-info">
    Information message
</div>
```

Features:
- Gradient backgrounds
- Colored left borders
- Proper spacing
- Drop shadows

### 4. Responsive Classes

#### Sidebar & Layout
```blade
<!-- Desktop: Sidebar + Content -->
<!-- Mobile: Stacked layout -->
@auth
    @if(auth()->user()->role !== 'peminjam')
        <div class="col-md-2 sidebar">
            <!-- Sidebar content -->
        </div>
        <div class="col-md-10 main-content">
            <!-- Main content -->
        </div>
    @endif
@endauth
```

#### Tables pada Mobile
```blade
<div class="table-responsive">
    <table class="table">
        <!-- Table content -->
    </table>
</div>
```

#### Responsive Buttons
```blade
<!-- Full width on mobile, inline on desktop -->
<div class="d-flex gap-2 flex-wrap">
    <button class="btn btn-primary">Action 1</button>
    <button class="btn btn-secondary">Action 2</button>
</div>
```

### 5. Animations

#### Fade In
```css
animation: fadeIn 0.3s ease-out;
```

#### Slide Up
```css
animation: slideInUp 0.3s ease-out;
```

#### Pulse
```css
animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
```

### 6. Utility Classes

#### Text Colors
```blade
<p class="text-primary">Primary text</p>
```

#### Backgrounds
```blade
<div class="bg-light-primary">Light primary background</div>
```

#### Borders
```blade
<div class="border-primary">Bordered element</div>
```

#### Shadows
```blade
<div class="shadow-sm">Small shadow</div>
<div class="shadow">Large shadow</div>
```

### 7. Typography

**Font Family:** Poppins (dari Google Fonts)
**Font Weights:** 300, 400, 500, 600, 700

```blade
<h1>Heading 1</h1>           <!-- 700 weight -->
<h2>Heading 2</h2>           <!-- 700 weight -->
<p>Regular paragraph</p>     <!-- 400 weight -->
<strong>Bold text</strong>   <!-- 600 weight -->
```

### 8. Best Practices

1. **Gunakan CSS Variables**
   - Lebih mudah maintain
   - Konsistensi warna
   - Easy theming

2. **Responsive First**
   - Test di mobile dulu
   - Gunakan media queries
   - Flexible layouts

3. **Accessibility**
   - Good color contrast
   - Proper focus states
   - Semantic HTML

4. **Performance**
   - Minimize animations
   - Use efficient selectors
   - Cache busting

### 9. Customization

Untuk mengubah warna primary:

```css
:root {
    --primary-gradient: linear-gradient(135deg, #NEW_COLOR_1 0%, #NEW_COLOR_2 100%);
    --primary-color: #NEW_COLOR_1;
    --secondary-color: #NEW_COLOR_2;
}
```

### 10. Browser DevTools Tips

```javascript
// Check all CSS variables
getComputedStyle(document.documentElement).getPropertyValue('--primary-color')

// Quick element inspection
// Inspect element > Computed tab
// Lihat CSS variables yang digunakan
```

---

**Last Updated:** February 2026
**Compatibility:** Bootstrap 5.1.3+
