const { defineConfig } = require("cypress");

module.exports = defineConfig({
  e2e: {
    baseUrl: 'http://localhost/REINTEGRA',
    setupNodeEvents(on, config) {
      // implement node event listeners here
    },
  },
});
