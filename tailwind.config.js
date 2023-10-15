/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            screens: {
                xs: { min: "0px", max: "639px" },
                sm: { min: "640px", max: "767px" },
                md: { min: "768px", max: "1023px" },
                lg: { min: "1024px", max: "1279px" },
                xl: { min: "1280px" },
            },
        },
    },
    plugins: [],
};
