class EmailValidator extends mx.data.binding.CustomValidator {
  public function validate(value:String) {
    if (value.indexOf("@") < 1) {
      this.validationError("Email addresses must contain an @ sign.");
    }
    if (  value.lastIndexOf("@") > value.lastIndexOf(".")  ) {
      this.validationError("There must be a dot after the @ sign.");
    }
  }
}