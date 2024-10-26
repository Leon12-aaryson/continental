def process_sql_file(input_file, output_file):
    with open(input_file, 'r') as file:
        sql_content = file.read()

    # Split the SQL content by semicolons to get each statement separately
    sql_statements = sql_content.split(';')

    with open(output_file, 'w') as file:
        for statement in sql_statements:
            # Strip leading/trailing whitespaces
            statement = statement.strip()
            if statement:
                formatted_statement = format_sql_statement(statement)
                # Check if the statement ends with a closing parenthesis followed by a comma
                if formatted_statement.endswith('),'):
                    file.write(formatted_statement + '\n')
                else:
                    file.write(formatted_statement + ';\n\n')

def format_sql_statement(statement):
    # Split the statement by spaces and reassemble to ensure lines are <= 40 characters
    words = statement.split()
    formatted_lines = []
    current_line = ""

    for word in words:
        # Check if adding the word would exceed 40 characters
        if len(current_line) + len(word) + 1 > 40:
            formatted_lines.append(current_line.strip())
            current_line = word
        else:
            current_line += " " + word

    # Add the last line if there's any remaining content
    if current_line:
        formatted_lines.append(current_line.strip())

    # Join the formatted lines to keep the statement together
    return ' '.join(formatted_lines)

# Usage
input_sql_file = 'continental.sql'   # Input file path
output_sql_file = 'output.sql'       # Output file path

process_sql_file(input_sql_file, output_sql_file)
