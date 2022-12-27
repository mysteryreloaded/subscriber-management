module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.vue",
        "./resources/**/*.js",
    ],
    theme: {
        extend: {
            flex: {
                '1-33': '1 1 33%',
            },
            width: {
                '33': '33%',
            }
        },
    },
    plugins: [],
}
