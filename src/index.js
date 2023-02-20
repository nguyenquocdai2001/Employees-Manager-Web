const path_var = require('path');
const express = require('express');
const morgan = require('morgan');
const handlebars = require('express-handlebars');
const { path } = require('express/lib/application');
const app = express();
const port = 3000;

const route = require('./routes');
const db = require('./config/db');

//Connect DB
db.connect();

//static file img
app.use(express.static(path_var.join(__dirname, 'public')));

//HTTP logger
app.use(morgan('combined'));

//middleware
app.use(
    express.urlencoded({
        extended: true,
    }),
);
app.use(express.json());

//Template engine (handlebars)
app.engine(
    'hbs',
    handlebars.engine({
        extname: '.hbs',
    }),
);
app.set('view engine', 'hbs');
app.set('views', path_var.join(__dirname, 'resources/views'));

//Route init
route(app);

app.listen(port, () => {
    console.log(`App listening on port ${port}`);
});
