Cypress.Commands.add('login', (email, password) => {
    cy.log('Wait between tests to prevent 429 - Too Many Requests (rate limiting)')
    cy.wait(5000);
    cy.visit('/login');
    cy.get('[name="email"]').type(email);
    cy.get('[name="password"]').type(password);
    cy.get('button[type="submit"]').click();
});

Cypress.Commands.add('selectFirstSelectableEmoji', () => {
    return cy.get('[data-cy="emoji-filter-emoji-selector"] span')
        .should('be.visible')
        .first()
        .then(($emoji) => {
            const emojiText = $emoji.text().trim();
            cy.wrap($emoji).click();
            cy.wait(500);
            return cy.wrap(emojiText);
        });
});
