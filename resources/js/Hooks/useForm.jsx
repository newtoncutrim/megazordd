import React from "react";

const types = {
    regex: /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
    message: "Preencha um email válido",
};

const useForm = (type) => {
    const [value, setValue] = React.useState("");
    const [error, setError] = React.useState("");

    function onChange({ target }) {
        if (error) validate(target.value);
        setValue(target.value);
    }

    function validate(value) {
        if (type === false) return true;
        if (value.length === 0) {
            setError("Preencha com um valor");
            return false;
        } else if (type[type] && !type[type].regex.test(value)) {
            setError(types[type].message);
            return false;
        } else {
            setError(null);
            return true;
        }
    }

    return {
        value,
        setValue,
        onChange,
        error,
        validate: () => validate(value),
        onBlur: () => validate(value),
    };
};

export default useForm;
