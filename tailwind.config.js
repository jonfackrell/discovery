module.exports = {
    theme: {
        extend: {
            colors: {
                byuigreen: {
                '100': '#80c140'
                },
                byuired: {
                '100': '#e42226'
                }
            }
        },
        minHeight: {
            '16': '4rem',
        }
    },
    variants: {},
    plugins: [
        require('@tailwindcss/ui'),
    ],
    purge: [
        './resources/views/**/*.php'
    ],
}
