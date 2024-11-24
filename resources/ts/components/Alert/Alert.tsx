import React from 'react';
import './Alert.scss';

export interface IAlert {
  text: string | undefined | null;
  type:
    | 'primary'
    | 'secondary'
    | 'success'
    | 'danger'
    | 'warning'
    | 'info'
    | 'light'
    | 'dark';
  dismissible?: boolean;
}

const Alert: React.FunctionComponent<IAlert> = (props: IAlert) => {
  if (!props.text) return null;
  return (
    <div
      className={
        'alert alert-' +
        props.type +
        (props.dismissible ? ' alert-dismissible' : '') +
        ' fade show'
      }
      role="alert"
    >
      <div className="alert-text">{props.text}</div>

      {props.dismissible && (
        <button
          type="button"
          className="btn-close"
          data-bs-dismiss="alert"
          aria-label="Close"
        ></button>
      )}
    </div>
  );
};

export default Alert;
