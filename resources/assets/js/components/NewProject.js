import axios from "axios";
import React, { Component } from "react";

class NewProject extends Component {
  constructor(props) {
    super(props);

    this.state = {
      name: "",
      description: "",
      cvrimg: null,
      errors: []
    };

    this.handleFieldChange = this.handleFieldChange.bind(this);
    this.handleCreateNewProject = this.handleCreateNewProject.bind(this);
    this.hasErrorFor = this.hasErrorFor.bind(this);
    this.renderErrorFor = this.renderErrorFor.bind(this);
    this.handleFieldChaneFile = this.handleFieldChaneFile.bind(this);
  }

  handleFieldChange(event) {
    this.setState({
      [event.target.name]: event.target.value
    });
  }

  handleFieldChaneFile(event) {
    this.setState({
      [event.target.name]: event.target.files[0]
    });
  }

  handleCreateNewProject(event) {
    event.preventDefault();

    const { history } = this.props;

    const formData = new FormData();
    formData.append("cvrimg", this.state.cvrimg);
    formData.append("name", this.state.name);
    formData.append("description", this.state.description);

    const config = {
      headers: {
        "content-type": "multipart/form-data"
      }
    };

    axios
      .post("api/projects", formData, config)
      .then(response => {
        alert("The Blog is successfully Posted");
        history.push("/");
      })
      .catch(error => {
        this.setState({
          errors: error.response.data.errors
        });
      });
  }

  hasErrorFor(field) {
    return !!this.state.errors[field];
  }

  renderErrorFor(field) {
    if (this.hasErrorFor(field)) {
      return (
        <span className="invalid-feedback">
          <strong>{this.state.errors[field][0]}</strong>
        </span>
      );
    }
  }

  render() {
    return (
      <div className="container py-4">
        <div className="row justify-content-center">
          <div className="col-md-6">
            <div className="card">
              <div className="card-header">Create new Blog</div>

              <div className="card-body">
                <form onSubmit={this.handleCreateNewProject}>
                  <div className="form-group">
                    <label htmlFor="name">Blog Title</label>
                    <input
                      id="name"
                      type="text"
                      className={`form-control ${
                        this.hasErrorFor("name") ? "is-invalid" : ""
                      }`}
                      name="name"
                      value={this.state.name}
                      onChange={this.handleFieldChange}
                    />
                    {this.renderErrorFor("name")}
                  </div>

                  <div className="form-group">
                    <label htmlFor="description">Blog Content</label>
                    <textarea
                      id="description"
                      className={`form-control ${
                        this.hasErrorFor("description") ? "is-invalid" : ""
                      }`}
                      name="description"
                      rows="10"
                      value={this.state.description}
                      onChange={this.handleFieldChange}
                    />
                    {this.renderErrorFor("description")}
                  </div>

                  <div className="form-group">
                    <label htmlFor="cvrimg">Blog Title</label>
                    <input
                      id="cvrimg"
                      type="file"
                      className={`form-control ${
                        this.hasErrorFor("cvrimg") ? "is-invalid" : null
                      }`}
                      name="cvrimg"
                      // value={this.state.cvrimg}
                      onChange={this.handleFieldChaneFile}
                    />
                    {this.renderErrorFor("cvrimg")}
                  </div>

                  <button className="btn btn-primary">Create</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  }
}

export default NewProject;
