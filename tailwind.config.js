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
            }
        }
    },
    plugins: [
        require("@tailwindcss/custom-forms")
    ]
}
