import os
import requests
import time

def download_stat_icons():
    output_folder = "dofus_stat_icons"
    os.makedirs(output_folder, exist_ok=True)

    # 1. Hit the meta endpoint which contains stats, effects, and conditions
    url = "https://api.dofusdu.de/dofus3/v1/meta/elements"
    
    headers = {"User-Agent": "Python Script - Icon Extractor"}
    
    print("Fetching stat and effect data from Dofusdude API... (This might take a second)")
    response = requests.get(url, headers=headers)
    
    if response.status_code == 200:
        data = response.json()
        
        # 2. Automatically find the largest list in the JSON response
        items_list = []
        if isinstance(data, list):
            items_list = data
        elif isinstance(data, dict):
            for key, value in data.items():
                if isinstance(value, list) and len(value) > len(items_list):
                    items_list = value

        print(f"Fetched {len(items_list)} effects/stats! Starting download...\n")

        if len(items_list) == 0:
            print("Error: Could not find any stat elements.")
            return

        # 3. Download each stat's image
        download_count = 0
        for item in items_list:
            name = item.get('name', 'Unknown')
            
            # The structure might vary slightly from items, so we safely look for image_urls
            image_urls = item.get('image_urls', {})
            image_url = None
            
            if isinstance(image_urls, dict):
                image_url = image_urls.get('hd') or image_urls.get('sd') or image_urls.get('icon')
            elif isinstance(item.get('image'), str): 
                # Fallback if the API returns a direct string URL instead of a dictionary
                image_url = item.get('image')

            if image_url:
                # Clean up the name for the file system
                safe_name = "".join([c for c in name if c.isalpha() or c.isdigit() or c == ' ']).rstrip()
                
                # Fallback name just in case an effect has a weird missing name
                if not safe_name:
                    safe_name = f"stat_effect_{item.get('id', download_count)}"
                    
                file_path = os.path.join(output_folder, f"{safe_name}.png")
                
                try:
                    img_data = requests.get(image_url).content
                    with open(file_path, 'wb') as handler:
                        handler.write(img_data)
                    
                    print(f"Downloaded: {safe_name}.png")
                    download_count += 1
                    time.sleep(0.05) # Polite delay
                except Exception as e:
                    print(f"Failed to download {name}: {e}")
                    
        print(f"\nSuccess! {download_count} stat icons have been saved to the '{output_folder}' folder.")
    else:
        print(f"Failed to fetch data - API returned Status Code: {response.status_code}")

if __name__ == "__main__":
    download_stat_icons()
