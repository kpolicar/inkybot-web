module.exports = {
    future: {
        // removeDeprecatedGapUtilities: true,
        // purgeLayersByDefault: true,
        // defaultLineHeights: true,
        // standardFontWeights: true
    },
    purge: [],
    theme: {
        extend: {
            backgroundImage: theme => ({
                'hero': "url('hero.png')",
            })
        }
    },
    variants: {
        display: ['responsive', 'group-hover', 'group-focus'],
    },
    plugins: []
}
