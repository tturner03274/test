const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    theme: {
        colors: {
            ...defaultTheme.colors,
            "brand-blue": "#0B0A3D",
            "brand-yellow": "#F2E90A",
            "brand-gray": {
                "500": "#9292AA",
                "400": "#BBBBD3",
                "300": "#E1E1E9",
                "200": "#F2F2F6",
                "100": "#F9F9FB"
            }
        },
        fontFamily: {
            ...defaultTheme.fontFamily,
            lato: ["Lato"],
            inter: ["Inter"]
        },
        fontSize: {
            ...defaultTheme.fontSize
        }
    },
    corePlugins: {
        container: false
    },
    plugins: [
        require("tailwindcss-aspect-ratio")({
            ratios: {
                square: [1, 1],
                "16/9": [16, 9],
                "4/3": [4, 3],
                "21/9": [21, 9]
            }
        }),
        require("tailwindcss-flexbox-order")()
    ],
    variants: {
        backgroundColor: ["responsive", "first", "last", "even", "odd", "hover", "focus"],
        borderRadius: ["responsive", "last"],
        margin: ["responsive", "last", "hover", "focus"],
        opacity: ["responsive", "hover", "focus", "disabled"]
    }
};
