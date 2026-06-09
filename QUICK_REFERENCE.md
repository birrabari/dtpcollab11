# Portal Ekskul - Quick Reference Guide

## For Developers: Quick Copy-Paste Components

### 1. Glassmorphic Container

```html
<div class="glass-container">
  Content here
</div>
```

```css
.glass-container {
  background: linear-gradient(135deg, rgba(255, 255, 255, 0.8) 0%, rgba(255, 255, 255, 0.6) 100%);
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
  border: 1px solid rgba(255, 255, 255, 0.2);
  border-radius: 32px;
  padding: 48px;
  box-shadow: 0 8px 32px rgba(15, 23, 42, 0.12), inset 0 1px 1px rgba(255, 255, 255, 0.5);
}
```

### 2. Premium Button

```html
<button class="btn-premium">Click Me</button>
```

```css
.btn-premium {
  padding: 14px 24px;
  background: linear-gradient(135deg, #FF6B35 0%, #FF8A65 100%);
  color: white;
  border: none;
  border-radius: 16px;
  font-size: 15px;
  font-weight: 700;
  cursor: pointer;
  transition: all 250ms cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 0 8px 24px rgba(255, 107, 53, 0.3);
}

.btn-premium:hover {
  transform: translateY(-2px);
  box-shadow: 0 12px 32px rgba(255, 107, 53, 0.4);
}

.btn-premium:active {
  transform: translateY(0);
}
```

### 3. Gradient Text

```html
<h1 class="gradient-text">Beautiful Text</h1>
```

```css
.gradient-text {
  background: linear-gradient(135deg, #FF6B35 0%, #0066FF 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}
```

### 4. Status Badge

```html
<span class="badge badge-success">Active</span>
<span class="badge badge-error">Failed</span>
```

```css
.badge {
  padding: 8px 14px;
  border-radius: 30px;
  font-size: 12px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.badge-success {
  background: linear-gradient(135deg, rgba(16, 185, 129, 0.15) 0%, rgba(52, 211, 153, 0.1) 100%);
  color: #10B981;
  border: 1px solid rgba(16, 185, 129, 0.3);
}

.badge-error {
  background: linear-gradient(135deg, rgba(239, 68, 68, 0.15) 0%, rgba(239, 68, 68, 0.1) 100%);
  color: #EF4444;
  border: 1px solid rgba(239, 68, 68, 0.3);
}
```

### 5. Hover Scale Card

```html
<article class="hover-card">
  <h3>Card Title</h3>
  <p>Card content</p>
</article>
```

```css
.hover-card {
  padding: 24px;
  border-radius: 24px;
  background: rgba(255, 255, 255, 0.8);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(255, 255, 255, 0.2);
  transition: all 250ms cubic-bezier(0.4, 0, 0.2, 1);
}

.hover-card:hover {
  transform: translateY(-8px) scale(1.02);
  box-shadow: 0 24px 60px rgba(15, 23, 42, 0.15);
}
```

### 6. Smooth Fade In Animation

```html
<div class="fade-in">Content</div>
```

```css
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.fade-in {
  animation: fadeInUp 0.6s ease-out forwards;
}
```

### 7. Focus State Styling

```css
button:focus,
input:focus {
  outline: none;
  box-shadow: 0 0 0 4px rgba(255, 107, 53, 0.1);
  border-color: #FF6B35;
}
```

### 8. Loading State

```html
<button class="btn-loading" disabled>Loading...</button>
```

```css
.btn-loading {
  opacity: 0.7;
  pointer-events: none;
  animation: pulse 2s infinite;
}

@keyframes pulse {
  0%, 100% { opacity: 0.7; }
  50% { opacity: 0.4; }
}
```

### 9. Responsive Text

```css
h1 {
  font-size: 48px;
}

@media (max-width: 768px) {
  h1 {
    font-size: 36px;
  }
}

@media (max-width: 640px) {
  h1 {
    font-size: 28px;
  }
}
```

### 10. Ripple Effect Button

```html
<button class="ripple-btn">Click Me</button>
```

```javascript
const buttons = document.querySelectorAll('.ripple-btn');
buttons.forEach(button => {
  button.addEventListener('click', function(e) {
    const rect = this.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);
    const x = e.clientX - rect.left - size / 2;
    const y = e.clientY - rect.top - size / 2;
    
    const ripple = document.createElement('span');
    ripple.style.cssText = `
      position: absolute;
      width: ${size}px;
      height: ${size}px;
      background: rgba(255,255,255,0.5);
      border-radius: 50%;
      left: ${x}px;
      top: ${y}px;
      pointer-events: none;
      animation: ripple 0.6s ease-out;
    `;
    
    if (!this.style.position || this.style.position === 'static') {
      this.style.position = 'relative';
    }
    
    this.appendChild(ripple);
    setTimeout(() => ripple.remove(), 600);
  });
});
```

```css
@keyframes ripple {
  to {
    transform: scale(2);
    opacity: 0;
  }
}
```

## CSS Variables Quick Reference

```css
/* Primary Colors */
--primary: #FF6B35
--primary-light: #FF8A65
--primary-dark: #E64A1C

/* Status Colors */
--success: #10B981
--error: #EF4444
--warning: #F59E0B
--info: #3B82F6

/* Text Colors */
--text-primary: #0F172A
--text-secondary: #475569
--text-tertiary: #94A3B8

/* Spacing */
--spacing-md: 16px
--spacing-lg: 24px
--spacing-xl: 32px

/* Shadows */
--shadow-sm: 0 2px 8px rgba(15, 23, 42, 0.06)
--shadow-md: 0 8px 24px rgba(15, 23, 42, 0.1)
--shadow-lg: 0 16px 40px rgba(15, 23, 42, 0.12)

/* Border Radius */
--radius-md: 16px
--radius-lg: 24px
--radius-xl: 32px

/* Transitions */
--transition-base: 250ms cubic-bezier(0.4, 0, 0.2, 1)

/* Blur */
--blur-lg: blur(20px)
```

## Common Tasks

### Change Primary Color
```css
:root {
  --primary: YOUR_COLOR; /* e.g., #3B82F6 */
}
```

### Add Dark Mode
```css
@media (prefers-color-scheme: dark) {
  :root {
    --bg-main: #0F172A;
    --text-primary: #F1F5F9;
  }
}
```

### Adjust Animation Speed
```css
:root {
  --transition-base: 350ms; /* Slower */
}
```

### Change Font
```css
body {
  font-family: 'YOUR_FONT', sans-serif;
}
```

### Increase Spacing
```css
:root {
  --spacing-lg: 32px; /* More generous */
}
```

## Debug Checklist

- [ ] Glassmorphism effect visible (backdrop-filter working)
- [ ] Gradients smooth and vibrant
- [ ] Shadows create proper depth
- [ ] Animations smooth (60fps)
- [ ] Responsive on mobile
- [ ] Accessibility focus visible
- [ ] Buttons have hover effects
- [ ] No console errors
- [ ] Colors accessible (contrast OK)
- [ ] Fonts loaded correctly

## File Structure

```
UKLKELAS11/
├── index.html              (Login page)
├── dashboard.html          (Main page)
├── style.css               (1090 lines of premium styling)
├── app.js                  (Enhanced interactions)
├── DESIGN_UPGRADE.md       (Comprehensive guide)
├── DESIGN_SYSTEM.md        (Component reference)
├── TRANSFORMATION_SUMMARY.md (Full details)
└── QUICK_REFERENCE.md      (This file)
```

## Useful Links

- **Google Fonts**: https://fonts.google.com/?query=sora+inter
- **Color Picker**: https://www.color-hex.com/
- **CSS Transitions**: https://cubic-bezier.com/
- **Accessibility**: https://www.a11y-101.com/

## Support

For questions about:
- **Design**: See DESIGN_SYSTEM.md
- **Full Details**: See DESIGN_UPGRADE.md
- **Components**: See TRANSFORMATION_SUMMARY.md
- **Quick Snippets**: See this file

---

**Last Updated**: June 2026  
**Version**: 1.0 Premium Edition  
**Status**: Production Ready ✨

Happy coding! 🚀
