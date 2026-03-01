module.exports = {
    future: {
        // removeDeprecatedGapUtilities: true,
        // purgeLayersByDefault: true,
        // defaultLineHeights: true,
        // standardFontWeights: true
    },
    purge: [],
    variants: {
        display: ['responsive', 'group-hover', 'group-focus'],
        translate: ['responsive', 'hover', 'focus', 'group-hover'],
    },
    theme: {
        extend: {
            cursor: {
                'zoom-in': 'zoom-in',
            },
            screens: {
                '2xl':     '1536px',
                '3xl':     '1800px',
                '4xl':     '2100px',
                '5xl':     '2560px',
                '6xl':     '3840px',
            }
        }
    },
    plugins: [
        require("@tailwindcss/custom-forms")
    ]
}
