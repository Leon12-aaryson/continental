def check_format(input_file):
    with open(input_file, 'r') as file:
        line_number = 0
        for line in file:
            line_number += 1
            line = line.strip()
            
            # Check if the line starts with ( and ends with )
            if not (line.startswith("(") and line.endswith("),")):
                print(f"Incorrect format on line {line_number}: {line}")
                continue
            
            # Remove enclosing parentheses and trailing comma
            cleaned_line = line.strip("(),")
            parts = cleaned_line.split(",")
            
            # Validate the structure (id, 'name', state_id)
            if len(parts) != 3:
                print(f"Unexpected number of parts on line {line_number}: {line}")
                continue
            
            try:
                city_id = int(parts[0].strip())
                name = parts[1].strip().strip("'")
                state_id = int(parts[2].strip())
                
                # Check if the name has single quotes
                if not (parts[1].strip().startswith("'") and parts[1].strip().endswith("'")):
                    print(f"Name not enclosed in single quotes on line {line_number}: {line}")

            except ValueError:
                print(f"Invalid number format on line {line_number}: {line}")

# Usage
input_file = 'cities.sql'
check_format(input_file)
