describe('Authentication Tests', () => {
    const baseUrl = 'http://127.0.0.1:8001';

    beforeEach(() => {
        cy.visit(`${baseUrl}/login`);
    });

    it('should not log in with an incorrect email', () => {
        cy.get('[name="email"]').type('wrongusername@example.com');
        cy.get('[name="password"]').type('abcdefgh');
        cy.get('button[type="submit"]').click();

        cy.url().should('include', '/login');

        cy.contains('These credentials do not match our records').should('be.visible');
    });

    it('should not log in with an incorrect password', () => {
        cy.get('[name="email"]').type('user1@example.com');
        cy.get('[name="password"]').type('wrongpassword');
        cy.get('button[type="submit"]').click();

        cy.url().should('include', '/login');

        cy.contains('These credentials do not match our records').should('be.visible');
    });

    it('should successfully log in with valid credentials', () => {
        cy.get('[name="email"]').type('user1@example.com');
        cy.get('[name="password"]').type('abcdefgh');
        cy.get('button[type="submit"]').click();

        cy.url().should('eq', `${baseUrl}/`);

        cy.get('[data-cy="the-navbar"]').should('exist');
    });
});
