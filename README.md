# Fresh

Fresh analytics for views... that's all for now. 🥳 Increase your insights with every call to your tag! 

Use this project as a free demo hosted by us or deploy it as a fully standalone app on your own server. 

We also have added fresh render which allows users to include stats in their github markdown.

> [!IMPORTANT]
> The url I had previously been using to host it publicly has been disabled - please rehost your own version of this project!
> If you want a quick rehost solution - you can deploy it as an instance through [SharePanel Host](https://sharepanel.host/signup.php?ref=1) - No Code Needed!

### Analytics Recording and Management in php

#### Overview

This document details how to manage dynamic data using PHP, specifically focusing on reading, writing, and editing JSON data stored in `analytics.json`. The functionality allows for creating, updating, and displaying data based on user input through a web interface.

#### URL Structure

The base URL for accessing this script is `https://shareps.000webhostapp.com/SP/MS/index.php`. Parameters can be appended to manage different modes and operations.

#### Functionality

The PHP script supports the following modes of operation:

1. **Read Mode (`mode=read`)**

   - Displays JSON data for a specific code.
   - If code exists, returns JSON data.
   - If code doesn't exist, prompts user with a form to enter a code.

   **Example Usage:**

   ```
   https://shareps.000webhostapp.com/SP/MS/index.php?mode=read&code=ExampleCode
   ```

2. **Write Mode (`mode=write`)**

   - Creates a new code entry with a timestamp and initializes visits to 0.
   - Displays a form to enter a new code.

   **Example Usage:**

   ```
   https://shareps.000webhostapp.com/SP/MS/index.php?mode=write
   ```

3. **Edit Mode (`mode=edit`)**

   - Updates an existing code's timestamp (`updated_at`) when user submits a form with a valid code.

   **Example Usage:**

   ```
   https://shareps.000webhostapp.com/SP/MS/index.php?mode=edit&code=ExampleCode
   ```

4. **Add Mode (`mode=add`)**

   - Increments the visit count of an existing code.
   - If the code doesn't exist, creates a new entry with 1 visit.

   **Example Usage:**

   ```
   https://shareps.000webhostapp.com/SP/MS/index.php?mode=add&code=ExampleCode
   ```


## Using Fresh's Renderer - Generating Dynamic Images with PHP

#### Overview

This section provides a guide on how to dynamically generate images using PHP, with customization options such as colors, fonts, special effects, and more. Each section will detail specific parameters and provide extensive URL templates to illustrate the possibilities.

#### URL Structure

The URL structure follows a pattern where parameters are appended to the base URL of the script (`render.php`). Here's a breakdown of the parameters used:

- **Base URL**: `https://shareps.000webhostapp.com/SP/MS/render.php`
- **Parameters**:
  - `code`: Specifies the code or identifier for data retrieval.
  - `text`: Text to display on the image.
  - `bg`: Background color in hex format.
  - `bg_fade`: Optional background fade color in hex format.
  - `text_colour`: Text color in hex format.
  - `border_colour`: Border color in hex format.
  - `special_effects`: Optional special effects like invert, grayscale, emboss, blur, sketch.
  - `font`: Optional font file path.
  - `font_size`: Font size in pixels.

#### Color Features

##### Background Color (`bg`)

- **Description**: Sets the main background color of the image.
- **Format**: Hexadecimal color code without the `#`.
- **Example**: `bg=1E3A5F` (Dark blue)

##### Background Fade (`bg_fade`)

- **Description**: Optional secondary background color for a gradient effect.
- **Format**: Hexadecimal color code without the `#`.
- **Example**: `bg_fade=16304B` (Darker blue)

##### Text Color (`text_colour`)

- **Description**: Sets the color of the text displayed on the image.
- **Format**: Hexadecimal color code without the `#`.
- **Example**: `text_colour=E0F7FA` (Light cyan)

##### Border Color (`border_colour`)

- **Description**: Sets the color of the border around the image.
- **Format**: Hexadecimal color code without the `#`.
- **Example**: `border_colour=90CAF9` (Light blue)

#### Special Effects (`special_effects`)

- **Description**: Applies visual effects to the image.
- **Options**: `none`, `invert`, `grayscale`, `emboss`, `blur`, `sketch`.

#### Font and Text Settings

- **Font File (`font`)**: Path to the TrueType font file.
- **Font Size (`font_size`)**: Size of the text in pixels.

### URL Templates

Here are some URL templates showcasing various combinations of parameters for generating different styles of images:

1. **Template 1: Gradient Background**
   ```
   https://sharepanel.host/dev/MS/render.php?code=Example1&text=Analytics&bg=FF5733&bg_fade=FFC300&text_colour=FFFFFF&border_colour=FF5733&special_effects=none&font=arial.ttf&font_size=20
   ```

2. **Template 2: Inverted Colors**
   ```
   https://sharepanel.host/dev/MS/render.php?code=Example2&text=Sales%20Report&bg=4CAF50&bg_fade=388E3C&text_colour=FFFFFF&border_colour=4CAF50&special_effects=invert&font=arial.ttf&font_size=18
   ```

3. **Template 3: Grayscale Effect**
   ```
   https://sharepanel.host/dev/MS/render.php?code=Example3&text=Monthly%20Visits&bg=607D8B&bg_fade=455A64&text_colour=FFFFFF&border_colour=607D8B&special_effects=grayscale&font=arial.ttf&font_size=16
   ```

4. **Template 4: Embossed Text**
   ```
   https://sharepanel.host/dev/MS/render.php?code=Example4&text=Revenue%20Projection&bg=F44336&bg_fade=EF5350&text_colour=FFFFFF&border_colour=F44336&special_effects=emboss&font=arial.ttf&font_size=22
   ```

5. **Template 5: Blurred Background**
   ```
   https://sharepanel.host/dev/MS/render.php?code=Example5&text=Customer%20Satisfaction&bg=9C27B0&bg_fade=AB47BC&text_colour=FFFFFF&border_colour=9C27B0&special_effects=blur&font=arial.ttf&font_size=24
   ```

6. **Template 6: Sketched Effect**
   ```
   https://sharepanel.host/dev/MS/render.php?code=Example6&text=Product%20Launch&bg=FF9800&bg_fade=FFB74D&text_colour=FFFFFF&border_colour=FF9800&special_effects=sketch&font=arial.ttf&font_size=20
   ```
