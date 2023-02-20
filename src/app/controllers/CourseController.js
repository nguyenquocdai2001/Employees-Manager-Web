const Course = require("../models/Course");
const  handleMongoose = require('../../util/mongoose');


class CourseController {
    //[GET] /courses/:slug
async show(req, res, next) {
    let test = await Course.findOne({slug: req.params.slug})
    res.json(test)
            // .then(course => {
            //     console.log(req.params.slug)
            //     res.json(course)
            // })
            // .catch(next)
    }
}

module.exports = new CourseController();
