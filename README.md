# HARDLAB

## About Us

[HARDLAB](https://github.com/AlejoMFernandez/HARDLAB) is an innovative project focused on gathering information at both hardware and software levels of computers. 
The program extracts essential details from each machine and presents them in an organized list on a web page. One unique feature of HardLab is its ability to automatically assign each computer to a specific section based on its location from a .json file.

If a machine belongs to a particular sector, a dedicated section is created for all computers in that area. Using the MAC address as a unique key in an SQL database ensures accurate identification. 
In case there is no registered computer for an existing section, the program generates a new section. Visually, each section is represented as a computer with the section name, providing an intuitive and efficient perspective of the computing environment.

Every hardware and software detail is obtained through a program developed in Python. This component is crucial for accurate information gathering, ensuring that HardLab can provide detailed data about the computers. 
Python acts as the engine behind the information retrieval, adding an extra layer of versatility and efficiency to the project.

## Project Structure

The HARDLAB website is structured using the following technologies:

- **JavaScript:** Enhances interactivity and user experience.
- **PHP:** Manages server-side functionalities and interaction with the database.
- **SQL:** Utilized for database management, particularly for storing MAC addresses and computer details.
- **Python:** The core component responsible for gathering hardware and software information.
- **HTML:** Structures the content and layout of the web pages.
- **CSS:** Enhances the visual aesthetics of the website.
- **JSON:** Used for storing and managing location-based information.

## Getting Started

To explore HARDLAB, follow these steps:

1. Clone the repository:
   ```bash
   git clone https://github.com/AlejoMFernandez/HARDLAB.git
