import os
import requests
import time

def download_forgemagic_runes():
    output_folder = "dofus_rune_icons"
    os.makedirs(output_folder, exist_ok=True)

    # 1. We will check all three main item categories just in case
    endpoints = [
        "https://api.dofusdu.de/dofus3/v1/en/items/resources/all",
        "https://api.dofusdu.de/dofus3/v1/en/items/consumables/all",
        "https://api.dofusdu.de/dofus3/v1/en/items/equipment/all"
    ]
    
    headers = {"User-Agent": "Python Script - Icon Extractor"}
    all_items = []
    
    print("Fetching data from Dofusdude API... (This might take a few seconds)")
    
    # 2. Fetch from all endpoints
    for url in endpoints:
        response = requests.get(url, headers=headers)
        if response.status_code == 200:
            data = response.json()
            
            # Automatically find the largest list in the JSON response, regardless of the key name
            items_list = []
            if isinstance(data, list):
                items_list = data
            elif isinstance(data, dict):
                for key, value in data.items():
                    if isinstance(value, list) and len(value) > len(items_list):
                        items_list = value
                        
            all_items.extend(items_list)
            print(f"Fetched {len(items_list)} items from {url.split('/')[-2]}")
        else:
            print(f"Failed to fetch {url} - Status: {response.status_code}")

    if not all_items:
        print("Error: Could not find any items from the API!")
        return

    print(f"\nTotal items loaded across all categories: {len(all_items)}")
    
    # 3. Filter for runes
    runes = []
    for item in all_items:
        item_type = item.get('type', {})
        type_name = ""
        
        if isinstance(item_type, dict):
            type_name = item_type.get('name', '').lower()
        else:
            type_name = str(item_type).lower()
        
        # Broaden the search term to catch all runes
        if "smithmagic rune" in type_name or "transcendence rune" in type_name or "corruption rune" in type_name or "rune" in type_name:
            runes.append(item)
            
    print(f"Filtered down to {len(runes)} runes! Starting download...\n")

    if len(runes) == 0:
        print("Error: The script checked all items but couldn't find any runes.")
        print("Here is a sample of the data to help debug:")
        print(all_items[0] if all_items else "No data")
        return

    # 4. Download each rune's image
    download_count = 0
    for rune in runes:
        name = rune.get('name', 'Unknown')
        
        image_urls = rune.get('image_urls', {})
        image_url = image_urls.get('hd') if isinstance(image_urls, dict) else None
        
        # Fallback to SD or icon if HD is somehow missing
        if not image_url and isinstance(image_urls, dict):
            image_url = image_urls.get('sd') or image_urls.get('icon')
        
        if image_url:
            safe_name = "".join([c for c in name if c.isalpha() or c.isdigit() or c == ' ']).rstrip()
            file_path = os.path.join(output_folder, f"{safe_name}.png")
            
            img_data = requests.get(image_url).content
            with open(file_path, 'wb') as handler:
                handler.write(img_data)
            
            print(f"Downloaded: {safe_name}.png")
            download_count += 1
            time.sleep(0.05) 
            
    print(f"\nSuccess! {download_count} runes have been saved to the '{output_folder}' folder.")

if __name__ == "__main__":
    download_forgemagic_runes()