describe('Authorization Tests', () => {

    it('User 2 should be able to see User 2’s notes', () => {
        cy.login('user2@example.com', 'abcdefgh');
        cy.visit(`${Cypress.config('baseUrl')}`);
        cy.contains('Note 1 - user 2').should('be.visible');
    });

    it('User 2 should be able to access User 2’s notes via direct URL', () => {
        cy.login('user2@example.com', 'abcdefgh');
        cy.request({
            url: `${Cypress.config('baseUrl')}/notes/2`,
            failOnStatusCode: false,
        }).then((response) => {
            expect(response.status).to.be.oneOf([200]);
        });
    });

    it('User 2 should NOT be able to see User 1’s notes', () => {
        cy.login('user2@example.com', 'abcdefgh');
        cy.visit(`${Cypress.config('baseUrl')}`);
        cy.contains('Note 1 - user 1').should('not.exist');
    });

    it('User 2 should NOT be able to access User 1’s notes via direct URL', () => {
        cy.login('user2@example.com', 'abcdefgh');
        cy.request({
            url: `${Cypress.config('baseUrl')}/notes/1`,
            failOnStatusCode: false,
        }).then((response) => {
            expect(response.status).to.be.oneOf([403, 404]);
        });
    });
});
