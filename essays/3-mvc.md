# The MVC Architecture Concept
The MVC or Model–view–controller is used to abstract the data representaion and logic (model) from the user interface (view).
This architecture is used to separate logic and data from the user interface to simplify the codebase and increase maintainability.

### Model
The model is how the application operate on data and logic,
it's manages data like a table in a database or user inputs,
In most applications the model usually represents a table in the database, and interact with it to add/get/update/delete data.

### View
The view is what the user sees, it represents the data to the user.
it's the user interface for an application.
it can also receive a user input or interaction.
The view receive the data from the model and sends user inputs to the controller.

### Controller
The controller is the middle point, it's responsible for the data flow, logic between the model and view.
it validates the user input from the view and update the model.
it also updates the view when the model changes.
