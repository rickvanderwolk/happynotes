describe("Notes CRUD Tests", () => {
    beforeEach(() => {
        const user = Cypress.env("users").user1;
        cy.login(user.email, user.password);
    });

    it("Creates a new note", () => {
        const tempId = `${Date.now()}`;
        let selectedEmojis = [];

        // Maak een nieuwe notitie
        cy.get('[data-cy="create-new-note"]').click();
        cy.get('[data-cy="new-note-title"]').type(`My first note - ${tempId}`);

        // Selecteer de eerste twee beschikbare emoji’s
        for (let i = 0; i < 2; i++) {
            cy.get('[data-cy="emoji-filter-emoji-selector"] span')
                .first()
                .then(($emoji) => {
                    const emojiText = $emoji.text().trim();
                    selectedEmojis.push(emojiText);
                    cy.wrap($emoji).click();
                    cy.wait(500); // Wacht zodat Livewire kan bijwerken
                });
        }

        // Sla de notitie op
        cy.get('[data-cy="save-new-note"]').click();
        cy.wait(1000); // Wacht tot Livewire de notitie heeft verwerkt

        // Controleer of de notitie correct is opgeslagen
        cy.get('[data-cy="note-list"] [data-cy="note-list-item"]')
            .first()
            .should("contain", `My first note - ${tempId}`)
            .as("firstNote"); // Alias maken voor de eerste notitie

        // Wacht tot de emoji-wrapper correct geladen is
        cy.get("@firstNote").find('[data-cy="emoji-wrapper"]').should("be.visible");

        // Log de emoji’s in de UI
        cy.get("@firstNote")
            .find('[data-cy="emoji-wrapper"]')
            .invoke("text")
            .then((emojiWrapperText) => {
                cy.log("Emoji's in UI:", emojiWrapperText.trim());
            });

        // Controleer of de geselecteerde emoji’s correct worden weergegeven
        selectedEmojis.forEach((emoji) => {
            cy.get("@firstNote").find('[data-cy="emoji-wrapper"]').should("contain.text", emoji);
        });
    });
});
