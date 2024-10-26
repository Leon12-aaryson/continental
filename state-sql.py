def format_cities(input_file, output_file):
    states = []

    with open(input_file, 'r') as file:
        # Read the entire file content
        content = file.read()
        # Split the content using the separator ")," and filter out any empty segments
        state_entries = [entry.strip() for entry in content.split("),") if entry.strip()]

        for entry in state_entries:
            # Add the closing parenthesis back temporarily to ensure consistency
            entry = entry + ")"
            # Strip whitespace and remove parentheses
            entry = entry.strip().strip("()")
            
            # Split the line into components
            parts = entry.split(",")
            # Extract data and remove extra quotes/spaces
            try:
                state_id = int(parts[0].strip())
                name = parts[1].strip().strip("'")
                country_id = int(parts[2].strip())

                # Create the Laravel array-style format
                state = f"['id' => {state_id}, 'name' => '{name}', 'country_id' => {country_id}]"
                states.append(state)
            except (ValueError, IndexError) as e:
                print(f"Error parsing entry: {entry}. Error: {e}")

    # Write to output file
    with open(output_file, 'w') as file:
        file.write("$states = [\n")
        for state in states:
            file.write(f"    {state},\n")
        file.write("];\n")

# Usage
input_file = 'states.sql'
output_file = 'formatted_states.php'
format_cities(input_file, output_file)
