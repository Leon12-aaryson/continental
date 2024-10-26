import re
from collections import defaultdict

# Define the path to your file
file_path = 'formatted_countries.php'

def find_duplicate_ids(file_path):
    # Create a dictionary to count occurrences of each ID
    id_counts = defaultdict(int)
    
    # Read the file content
    with open(file_path, 'r') as file:
        content = file.read()
    
    # Use regex to find all IDs in the specified format
    ids = re.findall(r'\[\'id\'\s*=>\s*(\d+)', content)
    
    # Count occurrences of each ID
    for id in ids:
        id_counts[int(id)] += 1

    # Find duplicates
    duplicates = {id: count for id, count in id_counts.items() if count > 1}
    
    return duplicates

# Find and print duplicate IDs
duplicates = find_duplicate_ids(file_path)
if duplicates:
    print("Duplicate IDs found:")
    for id, count in duplicates.items():
        print(f"ID {id} occurs {count} times.")
else:
    print("No duplicate IDs found.")
