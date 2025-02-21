import { defineConfig } from "cypress";

export default defineConfig({
  e2e: {
      baseUrl: "http://127.0.0.1:8001",
      env: {
          users: {
              user1: {
                  email: "user1@example.com",
                  password: "password1",
              },
              user2: {
                  email: "user2@example.com",
                  password: "password2",
              },
          },
      },
      setupNodeEvents(on, config) {
        // implement node event listeners here
      },
  },
});
