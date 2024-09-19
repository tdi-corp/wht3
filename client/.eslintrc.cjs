/* eslint-env node */
require('@rushstack/eslint-patch/modern-module-resolution')

module.exports = {
  root: true,
  'extends': [
    'plugin:vue/vue3-essential',
    'eslint:recommended',
    '@vue/eslint-config-prettier/skip-formatting'
  ],
  overrides: [
    {
      files: ['*.config.js'],
      env: {
        node: true,
      },
    },
  ],  
  parserOptions: {
    ecmaVersion: 'latest'
  },
  ignorePatterns: ['*.config.js'],
}
