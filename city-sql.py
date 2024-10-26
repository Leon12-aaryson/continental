def format_cities(input_file, output_file):
    cities = []

    with open(input_file, 'r') as file:
        # Read the entire file content
        content = file.read()
        # Split the content using the separator ")," and filter out any empty segments
        city_entries = [entry.strip() for entry in content.split("),") if entry.strip()]

        for entry in city_entries:
            # Add the closing parenthesis back temporarily to ensure consistency
            entry = entry + ")"
            # Strip whitespace and remove parentheses
            entry = entry.strip().strip("()")
            
            # Split the line into components
            parts = entry.split(",")
            # Extract data and remove extra quotes/spaces
            try:
                city_id = int(parts[0].strip())
                name = parts[1].strip().strip("'")
                state_id = int(parts[2].strip())

                # Create the Laravel array-style format
                city = f"['id' => {city_id}, 'name' => '{name}', 'state_id' => {state_id}]"
                cities.append(city)
            except (ValueError, IndexError) as e:
                print(f"Error parsing entry: {entry}. Error: {e}")

    # Write to output file
    with open(output_file, 'w') as file:
        file.write("$cities = [\n")
        for city in cities:
            file.write(f"    {city},\n")
        file.write("];\n")

# Usage
input_file = 'cities.sql'
output_file = 'formatted_cities.php'
format_cities(input_file, output_file)
