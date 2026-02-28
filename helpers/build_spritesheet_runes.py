import os
import math
import re
from PIL import Image

def create_spritesheet_and_css():
    input_folder = "dofus_rune_icons"
    output_image = "dofus_runes_spritesheet.png"
    output_css = "runes.css"
    
    # 1. Grab all PNGs and sort them alphabetically
    files = sorted([f for f in os.listdir(input_folder) if f.endswith('.png')])
    if not files:
        print(f"No PNG files found in '{input_folder}'.")
        return

    # 2. Get dimensions from the first image
    with Image.open(os.path.join(input_folder, files[0])) as img:
        icon_w, icon_h = img.size
    
    # 3. Calculate grid size
    num_icons = len(files)
    cols = math.ceil(math.sqrt(num_icons))
    rows = math.ceil(num_icons / cols)
    
    # 4. Create a transparent Canvas
    spritesheet = Image.new("RGBA", (cols * icon_w, rows * icon_h), (0, 0, 0, 0))
    
    # 5. Start the CSS file content
    css_content = [
        "/* Dofus Runes Sprite Sheet */",
        ".rune-icon {",
        f"    width: {icon_w}px;",
        f"    height: {icon_h}px;",
        f"    background-image: url('{output_image}');",
        "    background-repeat: no-repeat;",
        "    display: inline-block;",
        "}\n"
    ]

    print("Stitching images and generating CSS...")

    # 6. Paste images and calculate CSS mapping
    for index, filename in enumerate(files):
        # Calculate grid position
        col = index % cols
        row = index // cols
        
        # Calculate pixel coordinates
        x_pos = col * icon_w
        y_pos = row * icon_h
        
        # Paste into the master image
        img_path = os.path.join(input_folder, filename)
        with Image.open(img_path) as img:
            spritesheet.paste(img.convert("RGBA"), (x_pos, y_pos))
        
        # Sanitize filename for the CSS class
        clean_name = filename.replace(".png", "").lower()
        # Replace spaces or weird characters with hyphens
        clean_name = re.sub(r'[^a-z0-9]+', '-', clean_name).strip('-')
        class_name = f"rune-{clean_name}"
        
        # Format background position (CSS uses negative values to shift the background)
        bg_x = f"-{x_pos}px" if x_pos > 0 else "0"
        bg_y = f"-{y_pos}px" if y_pos > 0 else "0"
        
        # Add the class mapping to our CSS
        css_content.append(f".{class_name} {{ background-position: {bg_x} {bg_y}; }}")

    # 7. Save both files
    spritesheet.save(output_image)
    with open(output_css, "w") as f:
        f.write("\n".join(css_content))
        
    print(f"\nSuccess! Created '{output_image}' ({cols*icon_w}x{rows*icon_h} pixels).")
    print(f"Created '{output_css}' with {num_icons} ready-to-use classes.")

if __name__ == "__main__":
    create_spritesheet_and_css()
