module.exports = {
    theme: {
        fontFamily: {
            'display': 'Oswald, sans-serif',
            'body': '"Open Sans", sans-serif'
        },
        extend: {
            colors: {
                byuigreen: {
                    '100': '#CAE3AE',
                    '200': '#B4D88A',
                    '300': '#80C140',
                    '400': '#6B9D41'
                },
                byuipurple: {
                    '100': '#C879A9',
                    '200': '#BA4F8C',
                    '300': '#A5216F',
                    '400': '#63174E'
                },
                byuired: {
                    '100': '#EB7A7E',
                    '200': '#E95056',
                    '300': '#E42226',
                    '400': '#AC1F23'
                },
                byuiorange: {
                    '100': '#F6B46C',
                    '200': '#F59B42',
                    '300': '#F7941D',
                    '400': '#CB6028'
                },
                byuiyellow: {
                    '100': '#FBECA6',
                    '200': '#FCE68C',
                    '300': '#FFE066',
                    '400': '#FFCD03'
                },
                byuigrey: {
                    '100': '#EBEBEB',
                    '200': '#D2D2D2',
                    '300': '#ADADAD',
                    '400': '#525252'
                },
                byuiblue: {
                    '100': '#8DD3EE',
                    '200': '#3390F6',
                    '300': '#006EB6',
                    '400': '#194793'
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
        './resources/views/**/*.php',
        './app/Modules/**/resources/views/**/*.php'
    ],
}
