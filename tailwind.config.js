const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                "primary": {
                  50: "#F4F6FB",
                  100: "#E8EDF7",
                  200: "#D1DCEF",
                  300: "#BACAE8",
                  400: "#A4B9E0",
                  500: "#8FA9D9",
                  600: "#577EC6",
                  700: "#365BA0",
                  800: "#243D6B",
                  900: "#121E35",
                  950: "#090F1B"
                },
                "eunry": {
                  50: "#FAF5F4",
                  100: "#F7EEED",
                  200: "#F0DEDB",
                  300: "#E8CDC9",
                  400: "#E1BDB7",
                  500: "#D9ACA5",
                  600: "#C27B70",
                  700: "#A15144",
                  800: "#6C362D",
                  900: "#361B17",
                  950: "#190D0B"
                },
                "yellowGreen": {
                  50: "#F9FCF3",
                  100: "#F1F7E3",
                  200: "#E5F0CB",
                  300: "#D7E8B0",
                  400: "#CAE194",
                  500: "#BCD979",
                  600: "#A2CA44",
                  700: "#7D9F2D",
                  800: "#546B1E",
                  900: "#29340F",
                  950: "#161C08"
                }
              },
        },
    },

    
        
      

    plugins: [require('@tailwindcss/forms')],
};
