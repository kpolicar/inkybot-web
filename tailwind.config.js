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
            }
        }
    },
    plugins: [
        require("@tailwindcss/custom-forms")
    ]
}
