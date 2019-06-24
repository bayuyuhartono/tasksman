import axios from "axios";
import React, { Component } from "react";

class SingleProject extends Component {
  constructor(props) {
    super(props);

    this.state = {
      project: {},
      tasks: [],
      title: "",
      username: "",
      errors: []
    };

    this.handleFieldChange = this.handleFieldChange.bind(this);
    this.handleAddNewTask = this.handleAddNewTask.bind(this);
    this.hasErrorFor = this.hasErrorFor.bind(this);
    this.renderErrorFor = this.renderErrorFor.bind(this);
  }

  componentDidMount() {
    const projectId = this.props.match.params.id;

    axios.get(`/api/projects/${projectId}`).then(response => {
      this.setState({
        project: response.data,
        tasks: response.data.tasks
      });
    });
  }

  handleFieldChange(event) {
    this.setState({
      title: event.target.value
    });
  }

  handleAddNewTask(event) {
    event.preventDefault();

    const formData = new FormData();
    formData.append("title", this.state.title);
    formData.append("username", "= Admin =");
    formData.append("project_id", this.state.project.id);

    const config = {
      headers: {
        "content-type": "multipart/form-data"
      }
    };

    axios
      .post("/api/tasks", formData, config)
      .then(response => {
        alert("The Comment is successfully Added");
        this.setState({
          title: ""
        });
        // add new task to list of tasks
        this.setState(prevState => ({
          tasks: prevState.tasks.concat(response.data)
        }));
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
    const { project, tasks } = this.state;

    return (
      <div className="container py-4">
        <div className="row justify-content-center">
          <div className="col-md-8">
            <div className="card">
              <div className="card-header">{project.name}</div>

              <div className="card-body">
                <img className="card-header" width={685} height={300} mode='fit' src={project.img_cover} alt="cvrimg" />
                <p>{project.description}</p>

                <hr />

                <form onSubmit={this.handleAddNewTask}>
                  <div className="input-group">
                    <input
                      type="text"
                      name="title"
                      className={`form-control ${
                        this.hasErrorFor("title") ? "is-invalid" : ""
                      }`}
                      placeholder="Write Comment"
                      value={this.state.title}
                      onChange={this.handleFieldChange}
                    />

                    <div className="input-group-append">
                      <button className="btn btn-primary">Add</button>
                    </div>

                    {this.renderErrorFor("title")}
                  </div>
                </form>

                <ul className="list-group mt-3">
                  {tasks.map(task => (
                    <li
                      className="list-group-item d-flex justify-content-between align-items-center"
                      key={task.id}
                    >
                      {task.title}
                    </li>
                  ))}
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  }
}

export default SingleProject;
