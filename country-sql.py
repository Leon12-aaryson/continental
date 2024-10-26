def format_countries(input_file, output_file):
    countries = []

    with open(input_file, 'r') as file:
        for line in file:
            # Strip whitespace and remove parentheses
            line = line.strip().strip("(),")
            if line:
                # Split the line into components
                parts = line.split(",")
                # Extract data and remove extra quotes/spaces
                country_id = int(parts[0].strip())
                shortname = parts[1].strip().strip("'")
                name = parts[2].strip().strip("'")
                # Convert phone code to integer
                phonecode = int(parts[3].strip())

                # Create the Laravel array-style format
                country = f"['id' => {country_id}, 'shortname' => '{shortname}', 'name' => '{name}', 'phonecode' => {phonecode}]"
                countries.append(country)

    # Write to output file
    with open(output_file, 'w') as file:
        file.write("$countries = [\n")
        for country in countries:
            file.write(f"    {country},\n")
        file.write("];\n")

# Usage
input_file = 'countries.sql'
output_file = 'formatted_countries.php'
format_countries(input_file, output_file)
