workflow "Build, analyse and lint" {
  on = "push"
  resolves = ["Build"]
}

action "Build" {
  uses = "win0err/php-sic@master"
  args = "build"
  runs = "make"
}
