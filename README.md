
# BeesInTheTrap

## Overview

**BeesInTheTrap** is a command-line-based PHP game developed as part of an interview task. The goal is to destroy a hive of bees before they sting you to death. The game is designed using modern PHP styles and design principles, incorporating Symfony components while avoiding the use of a fully prebuilt framework. 

## Table of Contents

- [Overview](#overview)
- [Rules](#rules)
- [Installation](#installation)
- [How to Play](#how-to-play)
- [Features](#features)
- [Development Process](#development-process)
- [Technologies Used](#technologies-used)
- [Testing](#testing)
- [Future Improvements](#future-improvements)
- [License](#license)

## Rules

- The game runs from the command line.
- Players start with **100 HP** and aim to destroy all bees in the hive.
- Bees are categorized into three types: **Queen Bee**, **Worker Bee**, and **Drone Bee**.
- The game alternates turns between the player and the bees.
- A player types `hit` to take their turn. After the player’s turn, the bees attack.
- The game displays a message after each turn, describing the outcome, e.g., `"Direct Hit! You took 12 hit points from a Drone bee"`.
- The game ends when either all bees are dead or the player is dead.
- Players can `auto spin` to let the game play out automatically to its conclusion.

### Bee Types

#### Queen Bee
- **Lifespan:** 100 Hit Points
- **Hit Damage:** 10 HP deducted from the Queen’s lifespan per hit
- **Sting Damage:** Player loses 10 HP per sting
- **Quantity:** 1

#### Worker Bee
- **Lifespan:** 75 Hit Points
- **Hit Damage:** 25 HP deducted from Worker’s lifespan per hit
- **Sting Damage:** Player loses 5 HP per sting
- **Quantity:** 5

#### Drone Bee
- **Lifespan:** 60 Hit Points
- **Hit Damage:** 30 HP deducted from Drone’s lifespan per hit
- **Sting Damage:** Player loses 1 HP per sting
- **Quantity:** 25

### Game Mechanics

- Each bee type has different hit and sting damage.
- Bees and players have a chance to miss their attacks.
- The bee and player targets are chosen randomly but should reflect statistical chances based on bee types.
- Destroying the Queen Bee results in all remaining bees dying.

## Installation

To set up the game, follow these steps:

1. **Clone the Repository:**

   ```bash
   git clone https://github.com/yourusername/beesinthetrap.git
   ```

2. **Navigate to the Project Directory:**

   ```bash
   cd beesinthetrap
   ```

3. **Install Dependencies:**

   Ensure you have [Composer](https://getcomposer.org/) installed and run:

   ```bash
   composer install
   ```

4. **Make the Game Executable:**

   ```bash
   chmod +x beesinthetrap
   ```

## How to Play

To start the game, execute the following command from the project's root directory:

```bash
./beesinthetrap
```

### Gameplay Instructions

- **Manual Play:** Type `hit` when prompted to take your turn.
- **Auto Play:** Type `auto` to let the game run automatically to its conclusion.
- **Exit Game:** The game ends automatically when the player or all bees are dead, displaying a summary of the game.

## Features

- **Interactive Gameplay:** Turn-by-turn interaction with dynamic game messages.
- **Randomized Turns:** Random selection of bees for a statistically accurate game experience.
- **Single-Player Mode:** Play against the computer-controlled bee hive.
- **Auto-Spin Mode:** Option to let the game play out automatically.
- **Game Summary:** Displays detailed game results at the end.

## Development Process

This project was developed with the following approach:

1. **Analysis and Planning:** Thoroughly understanding the game rules and requirements.
2. **Design:** Outlining the game structure and flow.
3. **Implementation:** Writing the game logic in PHP, ensuring modern design principles.
4. **Testing:** Writing unit tests to ensure all components work as expected.
5. **Refinement:** Enhancing the game based on feedback and testing results.

## Technologies Used

- **PHP**: The main language used to develop the game.
- **Symfony Components**: Utilized `symfony/console` for command-line interactions.
- **Composer**: Used for managing PHP dependencies.

## Testing

Unit tests are included to ensure the game logic and components function correctly. To run the tests, execute the following command:

```bash
composer test
```

## Future Improvements

Here are some areas where the game could be expanded or improved:

- **Graphical Interface**: Implement a GUI version for a more visually engaging experience.
- **Difficulty Levels**: Add varying difficulty settings to challenge players.
- **Multiplayer Option**: Introduce a mode for multiple players to compete against each other.
- **Leaderboards**: Implement online leaderboards for global competition.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

---

Thank you for exploring **BeesInTheTrap**. Your feedback and contributions are welcome. Enjoy the game and aim for victory!
