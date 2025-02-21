describe('Authentication Tests', () => {
    it('should not log in with an incorrect email', () => {
        cy.login('wrongusername@example.com', 'abcdefgh');
        cy.url().should('include', '/login');
        cy.contains('These credentials do not match our records').should('be.visible');
    });

    it('should not log in with an incorrect password', () => {
        cy.login('user1@example.com', 'wrongpassword');
        cy.url().should('include', '/login');
        cy.contains('These credentials do not match our records').should('be.visible');
    });

    it('should successfully log in with valid credentials', () => {
        cy.login('user1@example.com', 'abcdefgh');
        cy.url().should('eq', `${Cypress.config('baseUrl')}/`);
        cy.get('[data-cy="the-navbar"]').should('exist');
    });
});
