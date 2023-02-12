const path_var = require('path')
const express = require('express')
const morgan = require('morgan')
const handlebars = require('express-handlebars')
const { path } = require('express/lib/application')
const app = express()
const port = 3000

//static file img
app.use(express.static(path_var.join(__dirname,'public')))

//HTTP logger
app.use(morgan('combined'))

//Template engine (handlebars)
app.engine('hbs', handlebars.engine({
    extname: '.hbs'
}))
app.set('view engine', 'hbs')
app.set('views', path_var.join(__dirname,'resources/views'))

app.get('/', (req, res) => {
  res.render('home');
})

app.get('/news', (req, res) => {
  res.render('news');
})

app.listen(port, () => {
  console.log(`Example app listening on port ${port}`)
})