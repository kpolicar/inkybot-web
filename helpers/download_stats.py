import os
import re
import requests
import time

def download_from_html():
    html_file = "stats.html"
    output_folder = "dofus_stat_icons"
    os.makedirs(output_folder, exist_ok=True)

    # 1. Read your uploaded HTML file
    try:
        with open(html_file, 'r', encoding='utf-8') as f:
            content = f.read()
    except FileNotFoundError:
        print(f"Error: Could not find '{html_file}' in the current directory.")
        return

    # 2. Regex to extract the image URL and the clean text name
    # It looks for <img src="..."> and then grabs the text inside the q-chip__content div
    pattern = re.compile(r'<img src="(https://dofusdb\.fr/icons/effects/[^"]+)".*?<div class="q-chip__content[^>]*>\s*(.*?)\s*</div>', re.DOTALL)
    
    matches = pattern.findall(content)
    print(f"Found {len(matches)} stats in the HTML file!\n")

    # 3. Download the images
    download_count = 0
    for img_url, name in matches:
        # Clean up the name (e.g., "AP Parry" becomes "APParry")
        safe_name = "".join([c for c in name if c.isalpha() or c.isdigit()]).rstrip()
        file_path = os.path.join(output_folder, f"{safe_name}.png")

        try:
            img_response = requests.get(img_url)
            if img_response.status_code == 200:
                with open(file_path, 'wb') as handler:
                    handler.write(img_response.content)
                print(f"SUCCESS: Downloaded '{safe_name}.png'")
                download_count += 1
            else:
                print(f"FAILED '{name}': 404 Error (Tried: {img_url})")
            
            time.sleep(0.05) # Polite delay
        except Exception as e:
            print(f"Error requesting '{name}': {e}")
            
    print(f"\nFinished! {download_count} stat icons have been saved.")

if __name__ == "__main__":
    download_from_html()