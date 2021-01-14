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
    },
    plugins: [
        require("@tailwindcss/custom-forms")
    ]
}
