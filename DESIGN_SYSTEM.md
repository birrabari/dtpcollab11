# Portal Ekskul - Design System Reference

A comprehensive guide to the premium design system implementation.

## Quick Start

### Color Usage Guide

#### Primary Colors (Action & Emphasis)
```
Primary Orange: #FF6B35 (CTAs, Links, Active States)
Light Orange: #FF8A65 (Gradients, Hover States)
Dark Orange: #E64A1C (Pressed States)
```

#### Status Colors
```
Success Green: #10B981 (Positive, Income, Accept)
Error Red: #EF4444 (Negative, Expense, Delete)
Warning Amber: #F59E0B (Caution, Pending)
Info Blue: #3B82F6 (Information, Secondary Action)
```

#### Backgrounds
```
Page BG: #FAFBFC (Fixed, light gradient)
Card BG: rgba(255,255,255,0.7-0.9) (Glass effect)
Hover BG: rgba(255,107,53,0.06-0.15) (Primary tinted)
```

## Component Patterns

### Glassmorphic Container
A semi-transparent element with blur background:

```css
background: rgba(255, 255, 255, 0.8);
backdrop-filter: blur(20px);
border: 1px solid rgba(255, 255, 255, 0.2);
box-shadow: 0 8px 32px rgba(15, 23, 42, 0.12);
border-radius: 32px;
```

### Gradient Button
Primary action with smooth gradient:

```css
background: linear-gradient(135deg, #FF6B35 0%, #FF8A65 100%);
box-shadow: 0 8px 24px rgba(255, 107, 53, 0.3);
transition: all 250ms cubic-bezier(0.4, 0, 0.2, 1);
```

On hover:
```css
transform: translateY(-2px);
box-shadow: 0 12px 32px rgba(255, 107, 53, 0.4);
```

### Status Badge
Semantic colored label:

```css
.status-in {
  background: linear-gradient(135deg, rgba(16, 185, 129, 0.15) 0%, rgba(52, 211, 153, 0.1) 100%);
  color: #10B981;
  border: 1px solid rgba(16, 185, 129, 0.3);
}

.status-out {
  background: linear-gradient(135deg, rgba(255, 107, 53, 0.15) 0%, rgba(255, 140, 101, 0.1) 100%);
  color: #FF6B35;
  border: 1px solid rgba(255, 107, 53, 0.3);
}
```

## Typography System

### Heading Hierarchy
```
H1 - 48px, weight 900 (Hero titles)
H2 - 22px, weight 800 (Section titles)
H3 - 24px, weight 700 (Card titles)
```

### Body Text
```
Large - 16px, weight 400-500 (Body copy)
Default - 14px, weight 400-500 (Standard text)
Small - 13px, weight 600 (Labels, metadata)
```

### Letter Spacing
```
Headings: -0.5px to -1px (tight, premium feel)
Body: 0px (default)
Labels: 0.5px to 1px (uppercase, distinguished)
```

## Spacing Measurements

**Use the spacing system consistently:**

```
4px   - Micro gaps, tight spacing
8px   - Small gaps between elements
16px  - Standard padding, small gaps
24px  - Section padding
32px  - Large padding, major gaps
48px  - Full section spacing
```

## Animation Speeds

Use these predefined timing values:

```
Fast:   150ms - Button clicks, micro interactions
Base:   250ms - Hover states, transitions
Slow:   350ms - Page transitions, emphasis animations
```

## Responsive Design Breakpoints

```
Desktop:  1400px+ (Full layout)
Tablet:   1024px - 1399px (Adjusted spacing)
Mobile:   768px - 1023px (Stacked layout)
Small:    640px - 767px (Mobile sidebar)
Tiny:     <640px (Minimal layout)
```

## Accessibility Checklist

- ✅ ARIA labels on form inputs
- ✅ Semantic HTML structure
- ✅ Color contrast ratios > 4.5:1
- ✅ Focus states visible (2px border)
- ✅ Keyboard navigation supported
- ✅ Icon + text for status indicators
- ✅ Form field descriptions
- ✅ Skip links if needed
- ✅ Alt text for images
- ✅ Respects `prefers-reduced-motion`

## Implementation Examples

### Creating a New Card

```html
<article class="card card-blue" aria-labelledby="card-title">
  <div>
    <h3 id="card-title">Card Title</h3>
    <p>Card description with metrics</p>
  </div>
  <div class="card-icon" aria-hidden="true"></div>
  <a href="#" class="btn-small">Action →</a>
</article>
```

```css
.card-blue {
  background: linear-gradient(135deg, rgba(0, 102, 255, 0.9) 0%, rgba(0, 153, 255, 0.7) 100%);
  backdrop-filter: blur(20px);
}
```

### Creating a New Button

```html
<button class="btn-primary">Button Text</button>
```

```css
.btn-custom {
  padding: 14px 24px;
  background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
  border: none;
  border-radius: 16px;
  color: white;
  font-weight: 700;
  transition: all 250ms cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 0 8px 24px rgba(255, 107, 53, 0.3);
}

.btn-custom:hover {
  transform: translateY(-2px);
  box-shadow: 0 12px 32px rgba(255, 107, 53, 0.4);
}
```

### Creating a Glassmorphic Section

```html
<section class="glass-section">
  <h2>Section Title</h2>
  <p>Content goes here</p>
</section>
```

```css
.glass-section {
  background: linear-gradient(135deg, rgba(255, 255, 255, 0.8) 0%, rgba(255, 255, 255, 0.6) 100%);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(255, 255, 255, 0.2);
  border-radius: 32px;
  padding: 48px;
  box-shadow: 0 8px 32px rgba(15, 23, 42, 0.12), inset 0 1px 1px rgba(255, 255, 255, 0.5);
}
```

## CSS Variable Reference

All design tokens are CSS variables. Customize by editing `:root`:

```css
:root {
  /* Colors */
  --primary: #FF6B35;
  --primary-light: #FF8A65;
  --primary-dark: #E64A1C;
  --success: #10B981;
  --error: #EF4444;
  --warning: #F59E0B;
  --info: #3B82F6;
  
  /* Backgrounds */
  --bg-main: #FAFBFC;
  --bg-secondary: #F3F4F6;
  --bg-tertiary: #FFFFFF;
  --bg-glass: rgba(255, 255, 255, 0.7);
  
  /* Text */
  --text-primary: #0F172A;
  --text-secondary: #475569;
  --text-tertiary: #94A3B8;
  
  /* Spacing */
  --spacing-sm: 8px;
  --spacing-md: 16px;
  --spacing-lg: 24px;
  --spacing-xl: 32px;
  --spacing-2xl: 48px;
  
  /* Shadows */
  --shadow-sm: 0 2px 8px rgba(15, 23, 42, 0.06);
  --shadow-md: 0 8px 24px rgba(15, 23, 42, 0.1);
  --shadow-lg: 0 16px 40px rgba(15, 23, 42, 0.12);
  
  /* Border Radius */
  --radius-sm: 10px;
  --radius-md: 16px;
  --radius-lg: 24px;
  --radius-xl: 32px;
  
  /* Transitions */
  --transition-fast: 150ms cubic-bezier(0.4, 0, 0.2, 1);
  --transition-base: 250ms cubic-bezier(0.4, 0, 0.2, 1);
  --transition-slow: 350ms cubic-bezier(0.4, 0, 0.2, 1);
  
  /* Blur Effects */
  --blur-sm: blur(8px);
  --blur-md: blur(12px);
  --blur-lg: blur(20px);
}
```

## Common Patterns

### Hover Scale Effect
```css
transition: transform 250ms cubic-bezier(0.4, 0, 0.2, 1), 
            box-shadow 250ms cubic-bezier(0.4, 0, 0.2, 1);

&:hover {
  transform: translateY(-2px) scale(1.02);
  box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
}
```

### Gradient Text
```css
background: linear-gradient(135deg, #FF6B35 0%, #0066FF 100%);
-webkit-background-clip: text;
-webkit-text-fill-color: transparent;
background-clip: text;
```

### Loading State
```css
opacity: 0.7;
pointer-events: none;
```

### Focus State
```css
&:focus {
  outline: none;
  box-shadow: 0 0 0 4px rgba(0, 102, 255, 0.1);
  border-color: #0066FF;
}
```

## Performance Tips

1. **Use CSS Variables** - Avoid inline styles
2. **Hardware Acceleration** - Use `transform` instead of `left/top`
3. **Efficient Selectors** - Avoid deep nesting
4. **Defer Non-Critical** - Load fonts asynchronously if needed
5. **Minimize Repaints** - Use `opacity` and `transform` for animations

## Browser Prefixes

Always include webkit prefixes for compatibility:

```css
backdrop-filter: blur(20px);
-webkit-backdrop-filter: blur(20px);

background-clip: text;
-webkit-background-clip: text;
-webkit-text-fill-color: transparent;
```

## Dark Mode Ready

The design system can easily support dark mode. Define dark mode variables:

```css
@media (prefers-color-scheme: dark) {
  :root {
    --bg-main: #0F172A;
    --bg-tertiary: #1E293B;
    --text-primary: #F1F5F9;
    --text-secondary: #CBD5E1;
  }
}
```

## Support & Questions

For implementation questions or custom components, refer to:
- `style.css` - Complete stylesheet with all components
- `index.html` - Login page example
- `dashboard.html` - Full dashboard implementation
- Component examples in any `.html` file

---

**Last Updated**: June 2026  
**Version**: 1.0 - Premium Design System  
**Status**: Production Ready ✨
