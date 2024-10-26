import re

# Read the file
with open('entries.py', 'r') as file:
    data = file.read()

# Extract all entries using regex
entries = re.findall(r'\(\d+,\'.*?\',\d+\)', data)

# Organize each entry into a separate line
organized_entries = '\n'.join(entries)

# Write the organized entries back to the file
with open('entries.py', 'w') as file:
    file.write(organized_entries)