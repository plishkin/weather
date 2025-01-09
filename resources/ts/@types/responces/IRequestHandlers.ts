import IResponse from './IResponse';
import IFailResponse from './IFailResponse';

export default interface IRequestHandlers {
  resolve: (resp: IResponse) => void;
  reject: (resp: IFailResponse) => void;
  finally: () => void;
}
