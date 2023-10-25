let tailwindcss = require("tailwindcss")

module.exports = {
  plugins: [
    tailwindcss("./tailwind.config.js"),
    require("postcss-loader"),
    require("autoprefixer")
  ]
}
