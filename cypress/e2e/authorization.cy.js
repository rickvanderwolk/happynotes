describe('Authorization Tests', () => {
    it('User 1 should be able to see User 1’s notes', () => {
        const user = Cypress.env("users").user1;
        cy.login(user.email, user.password);
        cy.visit(`${Cypress.config('baseUrl')}`);
        cy.contains(user.notes.first_note.content).should('be.visible');
    });

    it('User 2 should be able to see User 2’s notes', () => {
        const user = Cypress.env("users").user2;
        cy.login(user.email, user.password);
        cy.visit(`${Cypress.config('baseUrl')}`);
        cy.contains(user.notes.first_note.content).should('be.visible');
    });

    it('User 1 should be able to access User 1’s notes via direct URL', () => {
        const user = Cypress.env("users").user1;
        cy.login(user.email, user.password);
        cy.request({
            url: `${Cypress.config('baseUrl')}/notes/${user.notes.first_note.uuid}`,
            failOnStatusCode: false,
        }).then((response) => {
            expect(response.status).to.be.oneOf([200]);
        });
    });

    it('User 2 should be able to access User 2’s notes via direct URL', () => {
        const user = Cypress.env("users").user2;
        cy.login(user.email, user.password);
        cy.request({
            url: `${Cypress.config('baseUrl')}/notes/${user.notes.first_note.uuid}`,
            failOnStatusCode: false,
        }).then((response) => {
            expect(response.status).to.be.oneOf([200]);
        });
    });

    it('User 1 should NOT be able to see User 2’s notes', () => {
        const user = Cypress.env("users").user1;
        const differentUser = Cypress.env("users").user2;
        cy.login(user.email, user.password);
        cy.visit(`${Cypress.config('baseUrl')}`);
        cy.contains(differentUser.notes.first_note.content).should('not.exist');
    });

    it('User 2 should NOT be able to see User 1’s notes', () => {
        const user = Cypress.env("users").user2;
        const differentUser = Cypress.env("users").user1;
        cy.login(user.email, user.password);
        cy.visit(`${Cypress.config('baseUrl')}`);
        cy.contains(differentUser.notes.first_note.content).should('not.exist');
    });

    it('User 1 should NOT be able to access User 2’s notes via direct URL', () => {
        const user = Cypress.env("users").user1;
        const differentUser = Cypress.env("users").user2;
        cy.login(user.email, user.password);
        cy.request({
            url: `${Cypress.config('baseUrl')}/notes/${differentUser.notes.first_note.uuid}`,
            failOnStatusCode: false,
        }).then((response) => {
            expect(response.status).to.be.oneOf([403, 404]);
        });
    });

    it('User 2 should NOT be able to access User 1’s notes via direct URL', () => {
        const user = Cypress.env("users").user2;
        const differentUser = Cypress.env("users").user1;
        cy.login(user.email, user.password);
        cy.request({
            url: `${Cypress.config('baseUrl')}/notes/${differentUser.notes.first_note.uuid}`,
            failOnStatusCode: false,
        }).then((response) => {
            expect(response.status).to.be.oneOf([403, 404]);
        });
    });
});
