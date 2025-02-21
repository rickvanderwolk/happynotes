describe('Authorization Tests', () => {
    const baseUrl = 'http://127.0.0.1:8001';

    it('User 2 should be able to see User 2’s notes', () => {
        cy.visit(`${baseUrl}/login`);
        cy.get('[name="email"]').type('user2@example.com');
        cy.get('[name="password"]').type('abcdefgh');
        cy.get('button[type="submit"]').click();

        cy.visit(`${baseUrl}`);

        cy.contains('Note 1 - user 2').should('be.visible');
    });

    it('User 2 should be able to access User 2’s notes via direct URL', () => {
        cy.visit(`${baseUrl}/login`);
        cy.get('[name="email"]').type('user2@example.com');
        cy.get('[name="password"]').type('abcdefgh');
        cy.get('button[type="submit"]').click();

        cy.request({
            url: `${baseUrl}/notes/2`,
            failOnStatusCode: false,
        }).then((response) => {
            expect(response.status).to.be.oneOf([200]);
        });

        cy.request({
            url: `${baseUrl}/notes/1`,
            failOnStatusCode: false,
        }).then((response) => {
            expect(response.status).to.be.oneOf([403, 404]);
        });
    });

    it('User 2 should NOT be able to see User 1’s notes', () => {
        cy.visit(`${baseUrl}/login`);
        cy.get('[name="email"]').type('user2@example.com');
        cy.get('[name="password"]').type('abcdefgh');
        cy.get('button[type="submit"]').click();

        cy.visit(`${baseUrl}`);

        cy.contains('Note 1 - user 1').should('not.exist');
    });

    it('User 2 should NOT be able to access User 1’s notes via direct URL', () => {
        cy.visit(`${baseUrl}/login`);
        cy.get('[name="email"]').type('user2@example.com');
        cy.get('[name="password"]').type('abcdefgh');
        cy.get('button[type="submit"]').click();

        cy.request({
            url: `${baseUrl}/notes/1`,
            failOnStatusCode: false,
        }).then((response) => {
            expect(response.status).to.be.oneOf([403, 404]);
        });

        cy.request({
            url: `${baseUrl}/notes/1`,
            failOnStatusCode: false,
        }).then((response) => {
            expect(response.status).to.be.oneOf([403, 404]);
        });
    });
});
