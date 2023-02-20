const Courses = require("../models/Course");
const  handleMongoose = require('../../util/mongoose');


class SiteController {
    //[GET] /
    index(req, res, next) {
        Courses.find({})
        .then(courses => {
            res.render('home',{ 
                courses: handleMongoose.multipleMogooseToObject(courses)
            })
        })
        .catch(next);
    }

    //[GET] /search
    search(req, res) {
        res.render('search');
    }
}

module.exports = new SiteController();
