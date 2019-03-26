workflow "Build, analyse and lint" {
  on = "push"
  resolves = ["Lint", "Analyse"]
}

action "Build" {
  uses = "actions/docker/cli@master"
  args = "build -t php-sic ."
}

action "Lint" {
  needs = ["Build"]
  uses = "actions/docker/cli@master"
  args = "run --rm php-sic make lint"
}

action "Analyse" {
  needs = ["Build"]
  uses = "actions/docker/cli@master"
  args = "run --rm php-sic make analyze"
}