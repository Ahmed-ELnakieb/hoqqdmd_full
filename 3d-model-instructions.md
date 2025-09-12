# 3D Model Display Instructions

## Current Status
All slider images are currently **commented out** (hidden) in the hero section.

## To Show 3D Model / Images Again

### Option 1: Restore Original Images
To show the images again, uncomment the code in `home.php`:

1. **First Slider (Line 27-30):** 
   - Remove `<!--` from line 28 and `-->` from line 30
   - This will show: `shop_slider_img01.png`

2. **Second Slider (Line 46-49):**
   - Remove `<!--` from line 47 and `-->` from line 49
   - This will show: `wukung.png`

3. **Third Slider (Line 65-68):**
   - Remove `<!--` from line 67 and `-->` from line 68
   - This will show: `wukung.png`

### Option 2: Add 3D Model
To add a 3D model instead of images, replace the commented sections with:

```html
<div class="col-xl-5 col-lg-6">
    <div class="h-seven-slider-img text-center">
        <!-- Your 3D model code here -->
        <!-- Example using model-viewer: -->
        <model-viewer 
            src="path/to/your/3d-model.glb" 
            alt="3D Model"
            auto-rotate 
            camera-controls
            style="width: 100%; height: 500px;">
        </model-viewer>
    </div>
</div>
```

### Option 3: Add iframe for 3D Model
If using an external 3D model service:

```html
<div class="col-xl-5 col-lg-6">
    <div class="h-seven-slider-img text-center">
        <iframe 
            src="your-3d-model-url" 
            width="100%" 
            height="500" 
            frameborder="0">
        </iframe>
    </div>
</div>
```

## Quick Commands to Restore

When you say "open the 3D model" or want to show the images again, just say:
- "Uncomment the slider images"
- "Show the 3D model in slider"
- "Restore the slider images"

## Current Commented Sections Location
- **File:** `home.php`
- **Lines:** 27-30, 46-49, 65-68
- **Status:** All three slider images are commented out
