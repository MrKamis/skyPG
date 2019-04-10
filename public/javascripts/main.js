(() => {
    let howMuchCostNextSkill = (value, level, skill) => {
        switch (skill) {
            case 0:
                return Math.round(value * level * 0.1 + 5);
            case 1:
                return Math.round(value * level * 0.01 + 5);
            case 2:
                return Math.round(value * level * 0.25 + 5);
            case 3:
                return Math.round(value * level * 0.25 + 5);
            case 4:
                return Math.round(value * level * 0.75 + 5);
        }
    }

    if (document.getElementById('strength')) {
        let strength, health, critical, block, luck, coins, level;
        strength = document.getElementById('strength');
        strength.addEventListener('click', () => {
            let cost = howMuchCostNextSkill(strength.innerHTML, level, 0);
        });
    }
})();